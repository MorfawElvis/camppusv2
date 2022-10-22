@extends('layouts.app')
@section('title', 'Staff Registration')
@section('content')
    <div class="card shadow-lg">
        <div class="card-header bg-primary">
            <i class=" fas fa-arrow-alt-circle-down mr-1"></i>Staff Registration
        </div>
        <div class="card-body ">
            <a  class="btn btn-outline-primary rounded-pill float-right mb-2">
                <i class="fas fa-plus-circle mr-2"></i>Bulk Staff Upload</a>
            <form action="{{ route('admin.staff-registration.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mt-5">
                    <fieldset class="border p-4">
                        <legend  class="float-none w-auto">Staff's Details</legend>
                        <div class="row g-3">
                            <div class="col-lg-8">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control text-capitalize @error('fullName') is-invalid @enderror" name="fullName" placeholder="Full name">
                                    @error('fullName')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingInput" class="required">Full Name</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <input type="date"  class="form-control @error('dateOfBirth') is-invalid @enderror" name="dateOfBirth">
                                    @error('dateOfBirth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingInput" class="required">Date of Birth</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control text-capitalize @error('nationality') is-invalid @enderror" name="nationality"  placeholder="Nationality">
                                    <label for="floatingInput">Nationality</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <input type="text"  class="form-control text-capitalize @error('placeOfBirth') is-invalid @enderror" name="placeOfBirth" placeholder="Place of birth">
                                    @error('placeOfBirth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingInput" class="required">Place of Birth</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <select class="form-select @error('gender')is-invalid @enderror " aria-label="gender" name="gender">
                                    </select>
                                    @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingSelect" class="required">Gender</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <input type="date"  class="form-control @error('dateOfAdmission') is-invalid @enderror" name="dateOfAdmission">
                                    @error('dateOfAdmission')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingInput">Date of Employment</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <div class="form-floating">
                                        <select class="form-select @error('highest_qualification') is-invalid @enderror" aria-label="level" name="highest_qualification">
                                        </select>
                                        @error('highest_qualification')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <label for="floatingSelect">Highest Qualification</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <select class="form-select @error('position') is-invalid @enderror" aria-label="level" name="position">
                                    </select>
                                    @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingSelect">Position</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <select class="form-select @error('marital_status') is-invalid @enderror" aria-label="class" name="marital_status">
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
                                    <description>For example Kumba</description>
                                    <label for="floatingInput">Address</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="phoneNumber" placeholder="Phone number">
                                    <label for="floatingInput">Phone Number</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <select class="form-select" aria-label="denomination" name="denomination">
                                        <option>Denomination</option>
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
                        <legend  class="float-none w-auto">Staff's Profile</legend>
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
                                    <input type="password" class="form-control @error('passwordConfirmation') is-invalid @enderror" name="passwordConfirmation" placeholder="Confirm Password">
                                    @error('passwordConfirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
               <x-buttons.save/>
            </form>
        </div>
    </div>
@endsection


