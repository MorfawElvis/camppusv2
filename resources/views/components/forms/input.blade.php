@props(['disabled' => false, 'separator' => ''])
<div class="form-floating mb-3">
    <input id="{{ $fieldName }}" type="{{ $fieldType }}" wire:model.defer="{{ $fieldName }}"
           class="form-control text-capitalize @error($fieldName) is-invalid @enderror {{$separator}}"
           value="{{ $fieldValue ?? old($fieldName) }}" autofocus>
    @error($fieldName)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
    <label for="{{ $fieldName }}" class="required">{{ __($fieldLabel) }}</label>
</div>
