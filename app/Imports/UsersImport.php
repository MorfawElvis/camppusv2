<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Student;
use DB;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use PhpParser\Node\Stmt\TryCatch;

class UsersImport implements ToCollection, WithUpserts, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
              DB::transaction(function () use ($row) {
                $user = User::create([
                    'role_id' => 7,
                    'user_code' => (rand(100,1000) . Str::upper(Str::random(3))),
                    'password' => 'password',
                ]);
                Student::create([
                    'full_name' => $row['name'],
                    'date_of_birth' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['dob']),
                    'place_of_birth' => $row['pob'],
                    'gender' => $row['gender'],
                    'user_id' => $user->id,
                    'class_room_id' => request()->input('class_id')
                ]);
            });
        }
    }
    public function uniqueBy():string|array
    {
       return ['user_id', 'full_name'];
    }
}
