@extends('layouts.app')
@section('title', 'Student Bulk Upload')
@push('page-css')
    <style>
        .hide{
            display: none;
        }
    </style>
@endpush
@section('content')
    <div class="card shadow-lg w-75 mx-auto">
        <div class="card-header bg-primary">
          <div class="d-flex justify-content-between">
              <h6><i class=" fas fa-arrow-alt-circle-down me-1"></i>Student Bulk Upload - <span class="fw-bold">{{ $class_name->class_name }}</span></h6>
              <a href="{{ route('admin.manage.classes') }}" class="text-white text-decoration-none"><i class="fas fa-arrow-alt-circle-left me-1"></i>Back</a>
          </div>
        </div>
        <div class="card-body p-4">
            <x-forms.errors/>
            <form action="{{ route('admin.import.students') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="class_id" value="{{ $id }}">
                <div>
                    <label for="formFileLg" class="form-label">Choose file to upload</label>
                    <input class="form-control form-control-lg @error('file_upload') is-invalid @enderror" id="formFileLg" type="file" name="file_upload">
                    @error('file_upload') <small class="is-invalid">{{ $message }}</small>@enderror
                </div>
                <x-buttons.import/>
            </form>
        </div>
    </div>
@endsection
@push('page-scripts')
    <script>
        //Import button animation
        const button   = document.getElementById('import');
        const save   = document.getElementById('save-button');
        const btn_text = document.getElementById('button-text');
        const spinner  = document.getElementById("spinner");
        button.addEventListener('click', () => {
            btn_text.innerText = "Importing"
            spinner.classList.remove("hide");
        });
        save.addEventListener('click', () => {
            btn_text.innerText = "Saving"
            spinner.classList.remove("hide");
        });

    </script>
@endpush

