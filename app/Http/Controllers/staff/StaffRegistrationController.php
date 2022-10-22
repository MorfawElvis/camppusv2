<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\NewStaffRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StaffRegistrationController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        return view('staffRegistration.create');
    }
    public function store(NewStaffRequest $request)
    {
        $new_student = $request->validated();

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
