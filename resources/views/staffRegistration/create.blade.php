@extends('layouts.app')
@section('title', 'Staff Registration')
@section('content')
    <div class="card shadow-lg">
        <div class="card-header bg-primary">
            <i class=" fas fa-arrow-alt-circle-down mr-1"></i>{{ __('messages.staff_registration') }}
        </div>
        <div class="card-body ">
           <x-alerts/>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('admin.staff-registration.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mt-2">
                    <fieldset class="border p-4">
                        <legend  class="float-none w-auto">{{ __('messages.basic_info') }}</legend>
                        <div class="row g-3">
                            <div class="col-lg-8">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control text-capitalize @error('full_name') is-invalid @enderror" name="full_name" placeholder="Full name">
                                    @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingInput" class="required">{{ __('messages.full_name') }}</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <input type="date"  class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth">
                                    @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingInput" class="required">{{ __('messages.date_of_birth') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select " aria-label="nationality" name="nationality">
                                        <option value="">{{ __('messages.select_country') }}</option>
                                        @foreach($countries as $country)
                                            <option {{ old('$country') == $country ? 'selected' : '' }} value="{{$country}}">{{$country}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <input type="text"  class="form-control text-capitalize @error('place_of_birth') is-invalid @enderror" name="place_of_birth" placeholder="Place of birth">
                                    @error('place_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingInput" class="required">{{ __('messages.place_of_birth') }}</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <select class="form-select @error('gender')is-invalid @enderror " aria-label="gender" name="gender">
                                        <option value="">Select gender</option>
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
                                    <input type="date"  class="form-control @error('employment_date') is-invalid @enderror" name="employment_date">
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
                                            <option value="" selected>Open this select menu</option>
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
                                    <select class="form-select @error('position') is-invalid @enderror" aria-label="level" name="position" disabled>
                                        <option value="" selected>Open this select menu</option>
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
                                        <option value="" selected>Open this select menu</option>
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
                                        <option value="" selected>Open this select menu</option>
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
                                    <input type="text" class="form-control text-capitalize" name="address" placeholder="Address">
                                    <label for="floatingInput">Address</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="phone_number" placeholder="Phone number">
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
                                    <input type="text" class="form-control" name="insurance_number" placeholder="Insurance number">
                                    <label for="floatingInput">Insurance Number</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="row">
                    <fieldset class="border p-4">
                        <legend  class="float-none w-auto">{{ __('Login Information') }}</legend>
                        <div class="row g-3">
                            <div class="col-lg-3">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter email">
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
                                    <label for="formFile" class="form-label">Student's Photo</label>
                                    <input class="form-control @error('photo') is-invalid @enderror" type="file" name="photo">
                                    @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
               <x-buttons.save></x-buttons.save>
            </form>
        </div>
    </div>
@endsection


