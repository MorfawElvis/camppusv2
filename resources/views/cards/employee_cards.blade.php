@extends('layouts.app')
@section('title', 'Generate Employee Cards')
@push('page-css')
    <style>
        #loader{
            position:absolute;
            right: 18px;
            top: 10px;
            width: 20px;
        }
    </style>
@endpush
@section('content')
    <div class="card shadow-lg">
        <div class="card-header bg-primary">
            <i class=" fas fa-arrow-alt-circle-down mr-1"></i>Generate Employee Cards
        </div>
        <div class="card-body">
                <div class="d-flex justify-content-center p-4">
                    <a href="{{ route('admin.generate.employee.cards') }}" target="_blank" class="btn btn-primary btn-lg mx-auto" id="generate">
                    <i id="spinner" class="fa fa-spinner fa-spin hide mr-2"></i>
                        <span id="button-text">Generate Cards</span>
                    </a>
                </div>
        </div>
    </div>
@endsection
@push('page-scripts')
//TODO: Add timer to hide spinner
<script type="text/javascript">
     const button   = document.getElementById('generate');
     const btn_text = document.getElementById('button-text');
     const spinner  = document.getElementById("spinner");
    button.addEventListener('click', () => {
        btn_text.innerText = "Generating"
        spinner.classList.remove("hide");
    });
</script>
@endpush