<?php

namespace App\Services\Employee;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;

class EmployeeService
{
    public function storeEmployeeImage($file) : String
    {
        $img = ImageManagerStatic::make($file)->resize(400, 400)->sharpen(10)->encode('jpg');
        $name = Str::random().'.jpg';
        Storage::disk('public')->put('public/employees_photos/'.$name, $img);

        return $name;
    }
    public function createEmployee($request)
    {
        try {
         return   DB::transaction(function () use ($request) {
                if ($request->hasFile('photo')) {
                    $profile_image = $this->storeEmployeeImage($request->file('photo'));
                }
                $user = User::create([
                    'role_id' => $request->input('role'),
                    'user_code' => (rand(100, 1000) . Str::upper(Str::random(3))),
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                ]);
                Employee::create([
                    'full_name' => $request->input('full_name'),
                    'user_id' => $user->id,
                    'date_of_birth' => $request->input('date_of_birth'),
                    'place_of_birth' => $request->input('place_of_birth'),
                    'gender' => $request->input('gender'),
                    'highest_qualification' => $request->input('highest_qualification'),
                    'position' => $request->input('position'),
                    'marital_status' => $request->input('marital_status'),
                    'nationality' => $request->input('nationality'),
                    'denomination' => $request->input('denomination'),
                    'date_of_employment' => $request->input('employment_date'),
                    'address' => $request->input('address'),
                    'phone_number' => $request->input('phone_number'),
                    'insurance_number' => $request->input('insurance_number'),
                    'profile_image' => $profile_image ?? null,
                ]);
            });
        } catch (\Throwable $e) {
            report($e);
            return false;
        }
    }

    public function updateEmployee($request, $id) : void
    {
        DB::transaction( function () use ($request, $id) {
            if ($request->hasFile('photo')) {
                $profile_image = $this->storeEmployeeImage($request->file('photo'));
            }
            User::findOrFail($id)->update([
                'role_id' => $request->input('role'),
                'user_code' => (rand(100, 1000) . Str::upper(Str::random(3))),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);
            Employee::where('user_id', $id)->update([
                'full_name' => $request->input('full_name'),
                'date_of_birth' => $request->input('date_of_birth'),
                'place_of_birth' => $request->input('place_of_birth'),
                'gender' => $request->input('gender'),
                'highest_qualification' => $request->input('highest_qualification'),
                'position' => $request->input('position'),
                'marital_status' => $request->input('marital_status'),
                'nationality' => $request->input('nationality'),
                'denomination' => $request->input('denomination'),
                'date_of_employment' => $request->input('employment_date'),
                'address' => $request->input('address'),
                'phone_number' => $request->input('phone_number'),
                'insurance_number' => $request->input('insurance_number'),
                'profile_image' => $profile_image ?? null,
            ]);
        });
    }
}
