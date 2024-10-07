@extends('layouts.app')
@section('title', 'Student Registration')
@push('page-css')
    <style>
        #loader{
            position:absolute;
            right: 18px;
            top: 30px;
            width: 20px;
        }
    </style>
@endpush
@section('content')
    <div class="card shadow-lg">
        <div class="card-header bg-primary">
            <i class=" fas fa-arrow-alt-circle-down mr-1"></i>{{ __('Student Registration') }}
        </div>
        <div class="card-body ">
                <x-forms.errors/>
            <form action="{{ route('student-registration.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mt-2">
                    <fieldset class="border p-4">
                        <legend  class="float-none w-auto">{{ __('Basic Information') }}</legend>
                        <div class="row g-3">
                            <div class="col-lg-8">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control text-capitalize @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}"  placeholder="Full name">
                                    @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingInput" class="required">Full Name</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <input type="date"  class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                         id="datepicker">
                                    @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="datepicker" class="required">Date of Birth</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select " aria-label="nationality" name="nationality">
                                        <option value="">Select country</option>
                                        @foreach($countries as $country)
                                            <option {{ old('$country') == $country ? 'selected' : '' }} value="{{$country}}">{{$country}}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelect">Nationality</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <input type="text"  class="form-control text-capitalize @error('place_of_birth') is-invalid @enderror" name="place_of_birth" value="{{ old('place_of_birth') }}" placeholder="Place of birth">
                                    @error('place_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingInput" class="required">Place of Birth</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
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
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <input type="date"  class="form-control @error('date_of_admission') is-invalid @enderror" name="date_of_admission" value="{{ old('date_of_admission') }}">
                                    @error('date_of_admission')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingInput">Date of Admission</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select @error('section_id') is-invalid @enderror" aria-label="section" name="section_id" id="section_id">
                                        <option value="">Select section</option>
                                        @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('section_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingSelect" class="required">Section</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <select class="form-select @error('class_id') is-invalid @enderror" aria-label="class" name="class_id" id="class_id">
                                        <option value="">Select class</option>
                                    </select>
                                    <img id="loader" src="{{ asset('images/gifs/loading.gif') }}">
                                    @error('class_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <label for="floatingSelect" class="required">Class</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="row mt-2">
                    <fieldset class="border p-4">
                        <legend  class="float-none w-auto">{{ __("Parent's Address") }}</legend>
                        <div class="row g-3">
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control text-capitalize" name="address" placeholder="Address" value="{{ old('address') }}">
                                    <small>For example Kumba</small>
                                    <label for="floatingInput">Parent's Address</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="phone_number" placeholder="Phone number" value="{{ old('phone_number') }}">
                                    <label for="floatingInput">Parent's Phone Number</label>
                                    <small>For example 677195500</small>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating">
                                    <select class="form-select" aria-label="denomination" name="denomination">
                                        <option value="">Select denomination</option>
                                        @foreach($denominations as $denomination)
                                            <option {{ old('denomination' == $denomination) ? 'selected' : '' }} value="{{$denomination}}">{{$denomination}}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelect">Denomination</label>
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
                                    <label for="formFile" class="form-label">Profile Image</label>
                                    <input class="form-control @error('photo') is-invalid @enderror" type="file" name="photo">
                                    <small>Passport size photo not more than 2M</small>
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
@push('page-scripts')
<script>
    $(function() {
        var  loader = $("#loader");
             section_id = $('select[name="section_id"]');
             class_id  = $('select[name="class_id"]');

              loader.hide();
              class_id.attr('disabled', 'disabled');

              class_id.change(function() {
                var id = $(this).val();
                if(!id){
                    class_id.attr('disabled','disabled')
                }
              })
              section_id.change(function(){
                  var id = $(this).val();
                   if(id){
                    loader.show();
                    class_id.attr('disabled', 'disabled');

                    $.ajax({
                        url: '/class-rooms',
                        type: 'GET',
                        data: {section_id: id},
                        success: function(response){
                            var s ='<option value="">Select class</option>';
                           response.forEach(function(row) {
                              s += '<option value="'+row.id+'">'+row.class_name+'</option>'
                           })
                           class_id.removeAttr('disabled')
                           class_id.html(s);
                           loader.hide();
                        }
                    })
                   }
              })
    });
</script>
@endpush
