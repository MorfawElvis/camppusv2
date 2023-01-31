<div>
    @section('title', 'General Settings')
    <div class="card mx-auto shadow-lg">
            <div class="card-header bg-primary">
               <i class="fas fa-cogs mr-2"></i>
                General Settings
            </div>
            <div class="card-body">
                <form wire:submit.prevent="createSettings">
                    <div class="row p-3">
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <input type="text" wire:model.defer="form.school_name"  class="form-control @error('form.school_name') is-invalid @enderror" placeholder="Enter name of school">
                                @error('form.school_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <label for="floatingInput" class="required">School Name</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <input type="text"  class="form-control @error('form.school_address') is-invalid @enderror" wire:model.defer="form.school_address"   placeholder="Enter address of school">
                                @error('form.school_address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <label for="floatingPassword" class="required">School Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <input type="text" name="" class="form-control" wire:model.defer="form.school_po_box" id="floatingInput"  placeholder="Enter P.O Box number">
                                <label for="floatingInput">School P.O Box</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <input type="email" name="school_email" class="form-control @error('form.school_email') is-invalid @enderror" wire:model.defer="form.school_email"  placeholder="Enter school email">
                                @error('form.school_email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <label for="floatingPassword" class="required">School Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-sm-4">
                            <div class="form-floating">
                                <input type="text" name="" class="form-control" wire:model.defer="form.school_website" id="floatingInput"  placeholder="Enter school website">
                                <label for="floatingInput">School Website</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-floating">
                                <input type="tel"  class="form-control @error('form.school_phone_number') is-invalid @enderror" wire:model.defer="form.school_phone_number"  placeholder="Enter school phone number">
                                @error('form.school_phone_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <label for="floatingPassword" class="required">School Phone Number</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-floating">
                                <input type="tel"  class="form-control number-separator @error('form.boarding_fee') is-invalid @enderror" wire:model.defer="form.boarding_fee"  placeholder="Enter school phone number">
                                @error('form.boarding_fee')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <label for="floatingPassword">Boarding Fee</label>
                            </div>
                        </div>
                    </div>
                    <div class="row p-3 d-flex align-items-center">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="schoolLogo" class="form-label">School Logo</label>
                                <input class="form-control @error('school_logo') is-invalid @enderror" wire:model.defer="school_logo" type="file" id="schoolLogo">
                                @error('school_logo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            @if($school_logo)
                            <img src="{{ $school_logo->temporaryUrl() }}" class="rounded" style="width: 80px; height: 80px;">
                            @else
                             @isset($schoolSettings->school_logo)
                             <img src="{{ asset('storage/public/logo/'.$schoolSettings->school_logo)  }}" alt="school-logo" class="rounded">
                             @endisset
                            @endif
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="form-check">
                            <input class="form-check-input" wire:model.defer="form.collapsed_sidebar" type="checkbox" value="" id="collapse-sidebar">
                            <label class="form-check-label" for="collapse-sidebar">
                                Collapse Sidebar
                            </label>
                        </div>
                    </div>
                    {{--TODO: Remove cancel button and adjust button component--}}
                    <div class="float-right">
                        <button type="submit"  class="btn btn-primary rounded-pill"><i class="fas fa-save mr-1"></i>
                            <div wire:loading.delay class="spinner-border spinner-border-sm text-white"></div>
                          Save Changes
                        </button>
                    </div>
                </form>
            </div>
    </div>
</div>
@push('page-scripts')
    <script>
        $('#collapse-sidebar').on('change',function () {
            $('body').toggleClass('sidebar-collapse');
        })
    </script>
@endpush


