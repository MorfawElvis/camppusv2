<div>
    {{--    <x-loading-indicator/>--}}
    @section('title', 'Manage Database')
    <div class="row">
        <div class="col-md-3">
            <x-card.card>
                <x-slot:header>Manage Database</x-slot:header>
                <x-slot:body>
                    <div class="nav flex-column nav-pills text-start">
                        <div wire:ignore>
                            <button class="nav-link active backupDB"  data-bs-toggle="tab" data-bs-target="#backupDB">
                                <i class="fas fa-database me-2"></i>Backup Database</button>
                            <button class="nav-link"  data-bs-toggle="tab" data-bs-target="#restoreDB">
                                <i class="fas fa-trash-restore me-2"></i>Restore Database</button>
                        </div>
                    </div>
                </x-slot:body>
            </x-card.card>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="backupDB" wire:ignore.self>
                    <x-card.card>
                        <x-slot:header>Backup Database</x-slot:header>
                        <x-slot:body>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Backup Your Database Securely!</strong>
                                <ol>
                                    <li>Click the "Start Backup" button & Wait for the backup process to complete. Do not close the browser or navigate away from the page during this process.</li>
                                    <li>Once the backup is complete, download the backup file.
                                        Store the backup file in a secure location, such as an encrypted external drive or a secure cloud storage service.</li>
                                    <li>Regularly back up your database and Keep multiple backup copies to safeguard against data loss.</li>
                                </ol>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @if ($downloadLink)
                                <div class="text-success-emphasis mt-3">
                                    Backup completed! <a href="{{ $downloadLink }}">Download backup</a>
                                </div>
                            @elseif ($errorMessage)
                                <div class="text-danger-emphasis mt-3">
                                    Backup failed! {{ $errorMessage }}
                                </div>
                            @endif
                            <div class="d-flex align-items-center">
                                <button wire:click="startBackup" class="btn btn-primary" {{ $isProcessing ? 'disabled' : '' }}>
                                    Start Backup
                                </button>
                            <div wire:loading>
                                <div class="spinner-border text-primary ms-3" role="status">
                                </div>
                            </div>
                            </div>
                        </x-slot:body>
                    </x-card.card>
                </div>
                <div class="tab-pane fade" id="restoreDB" wire:ignore.self>
                    <x-card.card>
                        <x-slot:header>Restore Database</x-slot:header>
                        <x-slot:body>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Important:</strong> Before restoring the database, ensure you have the correct backup file. Restoring the database will overwrite existing data. Make sure to:
                                <ol>
                                    <li>Verify the backup file is the correct version you wish to restore.</li>
                                    <li>Ensure the backup file is not corrupted by checking its integrity.</li>
                                    <li>Backup the current database if needed before proceeding with the restoration.</li>
                                    <li>Ensure the file is in .sql format.</li>
                                </ol>
                            </div>
                            <form wire:submit.prevent="restoreDatabase" class="d-flex align-items-center">
                                <input type="file" wire:model="restoreFile" class="form-control me-3 w-50" {{ $isProcessing ? 'disabled' : '' }}>
                                <button type="submit" class="btn btn-danger" {{ $isProcessing ? 'disabled' : '' }}>Restore Database</button>
                               <div wire:loading>
                                   <div class="spinner-border text-primary ms-3" role="status">
                                       <span class="visually-hidden">Restoring Database...</span>
                                   </div>
                               </div>
                            </form>
                            @if ($restoreMessage)
                                <div class="alert alert-success mt-3">
                                    {{ $restoreMessage }}
                                </div>
                            @elseif ($errorMessage)
                                <div class="alert alert-danger mt-3">
                                    Restore failed! {{ $errorMessage }}
                                </div>
                            @endif
                        </x-slot:body>
                    </x-card.card>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('progressUpdated', progress => {
            document.querySelector('.progress-bar').style.width = progress + '%';
            document.querySelector('.progress-bar').setAttribute('aria-valuenow', progress);
            document.querySelector('.progress-bar').textContent = progress + '%';
        });
    });
</script>


