<div>
@section('title', 'Student List')
<div class="card shadow-lg">
    <div class="card-header bg-primary">
        <i class=" fas fa-arrow-alt-circle-down mr-1"></i>Student List
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover table-responsive-lg" wire:ignore.self>
          <div class="d-flex mb-3">
            <div class="col-3">
              <select class="form-select" wire:model="classId">
                  <option value="" selected>Select class</option>
                  @foreach ($class_rooms as $class_room)
                  <option value="{{ $class_room->id }}">{{ $class_room->class_name }}</option>
                  @endforeach
              </select>
            </div>
            <div class="col-8">
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
                <th>Place of Birth</th>
                <th>Date of Birth</th>
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
                <td>{{ $student->place_of_birth }}</td>
                <td>{{ \Carbon\Carbon::parse($student->date_of_birth)->format('d / m / Y') }}</td>
                <td>{{ $student->gender }}</td>
                <td>{{ $student->matriculation }}</td>
                <td>{{ $student->class_room->class_name }}</td>
                {{-- <td>{{ $student->user->user_code }}</td> --}}
                <td class="text-center">
                    <a wire:click.prevent="editStudentModal({{ $student }})" class="btn btn-xs btn-primary" wire:ignore.self><i class="fas fa-edit mr-2"></i>Edit</a>
                    <a wire:click.prevent="deleteStudent({{ $student->user->id }})" class="btn btn-xs btn-danger "><i class="fas fa-trash mr-1"></i>Delete</a>
                </td>
              </tr>
              @empty
                 <tr>
                    <td class="text-center" colspan="9">No available data</td>
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
<div class="modal fade" id="editStudentModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" tabindex="-1" wire:ignore.self>
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form wire:submit.prevent="updateStudent" class="form-floating">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
                <div class="form-floating mb-3">
                  <input type="text" wire:model.lazy="full_name" class="form-control text-capitalize @error('full_name') is-invalid @enderror">
                  @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  <label  class="required">Full Name</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" wire:model.lazy="place_of_birth" class="form-control" wire:model.lazy="place_of_birth">
                  <label for="floatingPassword">Place of Birth</label>
                  @error('place_of_birth') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                </div>
                <div class="form-floating mb-3">
                  <input type="date" wire:model.lazy="date_of_birth"  class="form-control @error('date_of_birth') is-invalid @enderror">
                  <small>Format: mm/dd/yyyy</small>
                  @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  <label for="floatingInput" class="required">Date of Birth</label>
                </div>
                <div class="mb-3">
                  <label for="formFile" class="form-label">Profile Image</label>
                  <input wire:model.lazy="photo" class="form-control @error('photo') is-invalid @enderror" type="file">
                  <small>Passport size photo not more than 2M</small>
                  @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>
            <div class="col-md-4 ms-auto">
              <div class="text-center">
                @if ($profile_image)
                <img class="profile-user-img img-fluid img-circle" 
                src="{{ asset('storage/public/students_photos/'.$profile_image) }}" alt="User profile picture">
                @elseif ($photo)
                <img src="{{ $photo->temporaryUrl() }}" class="profile-user-img img-fluid img-circle">
                @else   
                <img class="profile-user-img img-fluid img-circle" 
                src="{{ asset('storage/images/user.svg') }}" alt="User profile picture">
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="float-right mt-3">
          <button type="reset" class="btn btn-warning rounded-pill mr-2" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" id="save-button"  class="btn btn-primary rounded-pill">
              <i id="spinner" class="fa fa-spinner fa-spin hide mr-2"></i>
              <span class="button-text">Save Changes</span>
          </button>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>
</div>
@push('page-scripts')
    <script>
        window.addEventListener('showEditStudentModal', event => {
            $('#editStudentModal').modal('show');
        });
        window.addEventListener('hideEditStudentModal', event => {
            $('#editStudentModal').modal('hide');
        });
    </script>
@endpush
