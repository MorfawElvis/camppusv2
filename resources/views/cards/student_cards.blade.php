@extends('layouts.app')
@section('title', 'Generate Student Cards')
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
            <i class=" fas fa-arrow-alt-circle-down mr-1"></i>Generate Student Cards
        </div>
        <div class="card-body ">
           <x-forms.errors></x-forms.errors>
            <form action="{{ route('admin.generate.cards') }}" method="post" class=" row g-4 p-5">
                @csrf
                  <div class="col-sm-4">
                      <select class="form-select @error('section_id') is-invalid @enderror" aria-label="section" name="section_id" id="section_id" required>
                          <option value="">Select section</option>
                          @foreach ($sections as $section)
                          <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                          @endforeach
                      </select>
                      @error('section_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-sm-4">
                      <select class="form-select @error('class_id') is-invalid @enderror" aria-label="class" name="class_id" id="class_id" required>
                          <option value="">Select class</option>
                      </select>
                      <img id="loader" src="{{ asset('images/gifs/loading.gif') }}">
                      @error('class_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-sm-4">
                    <button type="submit" id="generate"  class="btn btn-primary mb-3">
                        <i id="spinner" class="fa fa-spinner fa-spin hide mr-2"></i>
                        <span id="button-text">Generate Cards</span>
                    </button>
                  </div>
            </form>
        </div>
    </div>
@endsection
@push('page-scripts')
<script type="text/javascript">
     const button   = document.getElementById('generate');
     const btn_text = document.getElementById('button-text');
     const spinner  = document.getElementById("spinner");
     
    $(function() {
        var  loader = $("#loader");
             section_id = $('select[name="section_id"]');
             class_id  = $('select[name="class_id"]');
             
              loader.hide();
              class_id.attr('disabled', 'disabled');
              button.disabled = true;
  
              class_id.change(function() {
                var id = $(this).val();
                if(!id){
                    class_id.attr('disabled','disabled')
                   
                }
                if(id){
                    button.disabled = false;
                }
              })
              section_id.change(function(){
                  var id = $(this).val();
                   if(id){
                    loader.show();
                    class_id.attr('disabled', 'disabled');
                    button.disabled = true;

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
    button.addEventListener('click', () => {
        btn_text.innerText = "Generating"
        spinner.classList.remove("hide");
    });
</script>
@endpush

