<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function upLoadView($id)
    {
        return view('users.student_bulk_import', compact('id'));
    }
    public function import(Request $request)
    {
        $request->validate([
            'file_upload' => 'required||mimes:xlsx, csv, xls'
        ],[
          'file_upload.required' => 'Please select the file to be uploaded',
        ]);
        try{
            Excel::import(new UsersImport, $request->file('file_upload'));
            return redirect()->back()->with('alert-success', 'Records successfully imported');
        }
        catch(Exception $e){
            return redirect()->back()->with('alert-danger', $e->getMessage());
        }
       
    }
}
