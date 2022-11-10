<div>
@section('title', 'Student List')
<div class="card shadow-lg">
    <div class="card-header bg-primary">
        <i class=" fas fa-arrow-alt-circle-down mr-1"></i>Student List
    </div>
    <div class="card-body ">
        <table class="table table-striped table-hover table-responsive-lg">
          <div class="d-flex mb-3">
            <div class="col-4">
                <input type="text" wire:model.debounce.300ms="search" class="form-control" placeholder="Search name or matriculation number">
            </div>
            <div class="ms-auto col-1">
                <select class="form-select" wire:model="perPage">
                    <option value="10" selected>10</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="30">30</option>
                  </select>
            </div>
        </div>
            <caption></caption>
            <thead>
              <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Matriculation</th>
                <th>Class</th>
                {{-- <th>Code</th> --}}
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($students as $student )
              <tr>
                <td>{{ $students->firstItem() + $loop->index }}</td>
                <td>{{ $student->full_name }}</td>
                <td>{{ $student->gender }}</td>
                <td>{{ $student->matriculation }}</td>
                <td>{{ $student->class_room->class_name }}</td>
                {{-- <td>{{ $student->user->user_code }}</td> --}}
                <td class="text-center">
                    <a class="btn btn-xs btn-primary"><i class="fas fa-edit mr-2"></i>Edit</a>
                    <a wire:click.prevent="deleteStudent({{ $student->user->id }})" class="btn btn-xs btn-danger "><i class="fas fa-trash mr-1"></i>Delete</a>
                </td>
              </tr>
              @empty
                 <tr>
                    <td colspan="7">No available data</td>
                 </tr>
              @endforelse
            </tbody>
         </table>
    </div>
    <div class="card-footer">
        <div class="float-end">
            {{ $students->links() }}
        </div>
    </div>
</div>
</div>
