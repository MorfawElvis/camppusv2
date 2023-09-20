@extends('layouts.app')
@section('title', 'Edit Staff')
@section('content')
    <div class="card shadow-lg">
        <div class="card-header bg-primary">
            <i class=" fas fa-arrow-alt-circle-down mr-1"></i>{{__('Edit Staff')}}
        </div>
        <div class="card-body ">
            <x-alerts/>
            <form action="{{ route('admin.staff-registration.update', [$employee->user->id]) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="current_page" value="{{ $current_page }}">
                <div class="row mt-2">
                    <fieldset class="border p-4">
                        <legend  class="float-none w-auto">{{ __('Basic Information') }}</legend>
                        <div class="row g-3">
                            <div class="col-lg-8">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control text-uppercase @error('full_name') is-invalid @enderror" name="full_name"
                                           value="{{ $employee->full_name }}" placeholder="Full name">
                                    @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingInput" class="required">Full Name</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <input type="date"  class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ $employee->date_of_birth }}">
                                    @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingInput" class="required">Date of Birth</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select " aria-label="nationality" name="nationality">
                                        <option value="{{ $employee->nationality }}">{{ $employee->nationality }}</option>
                                        @foreach($countries as $country)
                                            <option {{ old('$country') == $country ? 'selected' : '' }} value="{{$country}}">{{$country}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <input type="text"  class="form-control text-capitalize @error('place_of_birth') is-invalid @enderror" name="place_of_birth"
                                           value="{{ $employee->place_of_birth }}" placeholder="Place of birth">
                                    @error('place_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingInput" class="required">Place of Birth</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <select class="form-select @error('gender')is-invalid @enderror " aria-label="gender" name="gender">
                                        <option value="{{$employee->gender}}" selected>{{ $employee->gender }}</option>
                                        @foreach($genders as $gender)
                                            <option {{ old('gender' == $gender ? 'selected' : '') }} value="{{$gender}}">{{$gender}}</option>
                                        @endforeach
                                    </select>
                                    @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingSelect" class="required">Gender</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <input type="date"  class="form-control @error('employment_date') is-invalid @enderror" name="employment_date" value="{{ $employee->date_of_employment }}">
                                    @error('employment_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingInput">Date of Employment</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-3">
                                <div class="form-floating mb-3">
                                    <div class="form-floating">
                                        <select class="form-select @error('highest_qualification') is-invalid @enderror" aria-label="level" name="highest_qualification">
                                            <option value="{{ $employee->highest_qualification }}" selected>{{ $employee->highest_qualification }}</option>
                                            <option value="Ph.D">Ph.D</option>
                                            <option value="Master's Degree">Master's Degree</option>
                                            <option value="Bachelor's Degree">Bachelor's Degree</option>
                                            <option value="A/Level">Advanced Level</option>
                                            <option value="O/Level">Ordinary Level</option>
                                            <option value="FSLC">First School</option>
                                        </select>
                                        @error('highest_qualification')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <label for="floatingSelect" class="required">Highest Qualification</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <select class="form-select @error('position') is-invalid @enderror" aria-label="level" name="position">
                                        <option value="{{ $employee->position }}" selected>{{ $employee->position }}</option>
                                        <option value="Principal">Principal</option>
                                        <option value="Vice Principal">Vice Principal</option>
                                        <option value="Academic Dean">Academic Dean</option>
                                        <option value="Bursar">Bursar</option>
                                        <option value="Accountant">Accountant</option>
                                        <option value="Teacher">Teacher</option>
                                        <option value="Support Staff">Support Staff</option>
                                    </select>
                                    @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingSelect">Position</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <select class="form-select @error('role') is-invalid @enderror" aria-label="class" name="role">
                                        <option value="{{ $employee->user->role->id }}" selected>{{ $employee->user->role->role_name }}</option>
                                        @foreach($roles as $role)
                                            <option {{ old('role' == $role ? 'selected' : '') }} value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingSelect" class="required">Role</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <select class="form-select @error('marital_status') is-invalid @enderror" aria-label="class" name="marital_status">
                                        <option value="{{ $employee->marital_status }}" selected>{{ $employee->marital_status }}</option>
                                        <option value="Married">Married</option>
                                        <option value="Single">Single</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    @error('marital_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingSelect">Marital Status</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control text-capitalize" name="address" placeholder="Address" value="{{ $employee->address }}">
                                    <label for="floatingInput">Address</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="phone_number" placeholder="Phone number" value="{{ $employee->phone_number }}">
                                    <label for="floatingInput">Phone Number</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <select class="form-select" aria-label="denomination" name="denomination">
                                        <option value="">Select denomination</option>
                                        @foreach($denominations as $denomination)
                                            <option {{ old('denomination' == $denomination) ? 'selected' : '' }} value="{{$denomination}}">{{$denomination}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="insurance_number" placeholder="Insurance number" value="{{ $employee->insurance_number }}">
                                    <label for="floatingInput">Insurance Number</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="row">
                    <fieldset class="border p-4">
                        <legend  class="float-none w-auto">{{__('Login Information')}}</legend>
                        <div class="row g-3">
                            <div class="col-lg-3">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter email"
                                    value="{{ $employee->user->email }}">
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingInput">Email</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password">
                                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingInput">Password</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirm Password">
                                    @error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingInput">Password Confirmation</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Staff's Photo</label>
                                    <input class="form-control @error('photo') is-invalid @enderror" type="file" name="photo">
                                    @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="float-right mt-3">
                    <button type="reset" class="btn btn-warning rounded-pill mr-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="save-button"  class="btn btn-primary rounded-pill">
                        <i id="spinner" class="fa fa-spinner fa-spin hide mr-2"></i>
                        <span class="button-text">Save Changes</span></button>
                </div>
            </form>
        </div>
    </div>
@endsection


