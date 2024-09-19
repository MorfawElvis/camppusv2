<?php

namespace App\Http\Livewire\Security;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ManageDatabase extends Component
{
    use WithFileUploads;

    public $backupFileName;
    public $backupFilePath;
    public $isProcessing = false;
    public $downloadLink = null;
    public $errorMessage = null;
    public $restoreFile;
    public $restoreMessage = null;

    public function startBackup()
    {
        $this->isProcessing = true;
        $this->downloadLink = null;
        $this->errorMessage = null;
        $this->restoreMessage = null;

        try {

            $appName = env('APP_NAME');
            $this->backupFileName = $appName.'-' . now()->format('Y-m-d_H-i-s') . '.sql';
            $this->backupFilePath = storage_path('app/backup/' . $this->backupFileName);

            $mysqldumpPath = env('MYSQLDUMP_PATH', '/usr/bin/mysqldump');
            $dbHost = env('DB_HOST', '127.0.0.1');
            $dbPort = env('DB_PORT', '3306');
            $dbName = env('DB_DATABASE', 'camppus_v2');
            $dbUsername = env('DB_USERNAME', 'root');
            $dbPassword = env('DB_PASSWORD', 'admin1234');

            $command = "$mysqldumpPath --user=$dbUsername --password=$dbPassword --host=$dbHost --port=$dbPort $dbName > $this->backupFilePath";

            Log::info("Running command: $command");

            $process = Process::fromShellCommandline($command);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            $this->downloadLink = route('admin.download-backup', ['filename' => $this->backupFileName]);
        } catch (\Exception $e) {
            $this->errorMessage = $e->getMessage();
            Log::error('Backup failed: ' . $e->getMessage());
        } finally {
            $this->isProcessing = false;
        }
    }

    public function restoreDatabase()
    {
        $this->isProcessing = true;
        $this->errorMessage = null;
        $this->restoreMessage = null;

        try {
            $this->validate([
                'restoreFile' => 'required|file|mimes:sql',
            ]);

            $uploadedFilePath = $this->restoreFile->store('restore');
            $restoreFilePath = storage_path('app/' . $uploadedFilePath);

            // Read the SQL file
            $sqlContent = file_get_contents($restoreFilePath);

            // Extract CREATE TABLE and INSERT INTO statements
            list($createTableStatements, $insertDataStatements, $backupTables) = $this->extractSqlStatements($sqlContent);

            // Get the current database tables
            $currentTables = \DB::connection()->getDoctrineSchemaManager()->listTableNames();

            // Compare tables
            $missingTables = array_diff($currentTables, $backupTables);
            $extraTables = array_diff($backupTables, $currentTables);

            if (!empty($missingTables) || !empty($extraTables)) {
                throw new \Exception('The tables in the backup file do not match the existing database tables.');
            }

            // Disable foreign key checks
            \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // Drop tables in reverse order to avoid foreign key issues
            foreach (array_reverse(array_keys($createTableStatements)) as $table) {
                if (in_array($table, $currentTables)) {
                    \DB::statement("DROP TABLE IF EXISTS `$table`");
                }
            }

            // Create tables in correct order
            foreach ($createTableStatements as $table => $createStatement) {
                \DB::statement($createStatement);
            }

            // Insert data in correct order
            foreach ($insertDataStatements as $table => $insertStatements) {
                foreach ($insertStatements as $insertStatement) {
                    \DB::statement($insertStatement);
                }
            }

            // Enable foreign key checks
            \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $this->restoreMessage = 'Database restoration completed successfully!';
        } catch (\Exception $e) {
            $this->errorMessage = $e->getMessage();
            Log::error('Restore failed: ' . $e->getMessage());
        } finally {
            $this->isProcessing = false;
        }
    }

    private function extractSqlStatements($sqlContent)
    {
        // Extract CREATE TABLE statements
        preg_match_all('/CREATE TABLE[^;]+;/', $sqlContent, $createMatches);
        $createStatements = [];
        $backupTables = [];
        foreach ($createMatches[0] as $statement) {
            preg_match('/CREATE TABLE `([^`]+)`/', $statement, $tableNameMatch);
            $tableName = $tableNameMatch[1];
            $createStatements[$tableName] = $statement;
            $backupTables[] = $tableName;
        }

        // Extract INSERT INTO statements and group by table
        preg_match_all('/INSERT INTO `([^`]+)`[^;]+;/', $sqlContent, $insertMatches);
        $insertStatements = [];
        foreach ($insertMatches[0] as $statement) {
            preg_match('/INSERT INTO `([^`]+)`/', $statement, $tableNameMatch);
            $tableName = $tableNameMatch[1];
            $insertStatements[$tableName][] = $statement;
        }

        return [$createStatements, $insertStatements, $backupTables];
    }


    public function render()
    {
        return view('livewire.security.manage-database');
    }

}
