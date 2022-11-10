@extends('layouts.app')
@section('title', 'Student List')
@section('content')
<div class="card shadow-lg">
    <div class="card-header bg-primary">
        <i class=" fas fa-arrow-alt-circle-down mr-1"></i>Staff List
    </div>
    <div class="card-body ">
         <table class="table table-striped table-hover table-responsive-lg">
            <caption>{{ $staffs->links() }}</caption>
            <thead>
              <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Function</th>
                <th>Matriculation</th>
                <th>Qualification</th>
                <th>Code</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($staffs as $staff )
              <tr>
                <td>{{ $staffs->firstItem() + $loop->index }}</td>
                <td>{{ $staff->full_name }}</td>
                <td>{{ $staff->position }}</td>
                <td>{{ $staff->matriculation }}</td>
                <td>{{ $staff->highest_qualification }}</td>
                <td>{{ $staff->user->user_code }}</td>
                <td class="text-center">
                    <a class="btn btn-xs btn-primary"><i class="fas fa-edit mr-2"></i>Edit</a>
                    <a class="btn btn-xs btn-danger "><i class="fas fa-trash mr-1"></i>Delete</a>
                </td>
              </tr>
              @empty
                  
              @endforelse
            </tbody>
         </table>
    </div>
</div>
@endsection