<div>
    @section('title', 'Student List')
    <div class="card shadow-lg">
        <div class="card-header bg-primary">
            <i class=" fas fa-arrow-alt-circle-down mr-1"></i>Staff List
        </div>
        <div class="card-body ">
            <x-alerts/>
             <table class="table table-striped table-hover table-responsive-lg">
                <caption>{{ $employees->links() }}</caption>
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
                  @forelse ($employees as $employee )
                  <tr>
                    <td>{{ $employees->firstItem() + $loop->index }}</td>
                    <td>{{ $employee->employee->full_name }}</td>
                    <td>{{ $employee->employee->position }}</td>
                    <td>{{ $employee->employee->matriculation }}</td>
                    <td>{{ $employee->employee->highest_qualification }}</td>
                    <td>{{ $employee->user_code }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.edit.staff', ['staff_id' => $employee->id, 'current_page' => $employees->currentPage()]) }}" class="btn btn-xs btn-primary"><i class="fas fa-edit mr-2"></i>Edit</a>
                        <a wire:click.prevent="deleteConfirmation({{ $employee->id }})" class="btn btn-xs btn-danger "><i class="fas fa-trash mr-1"></i>Delete</a>
                    </td>
                  </tr>
                  @empty
                     <tr>
                        <td class="text-center" colspan="7">No available data</td>
                     </tr>
                  @endforelse
                </tbody>
             </table>
        </div>
    </div>
</div>
