<input type="{{ $fieldType }}"  id="{{ $fieldName }}"
       wire:model="{{ $fieldName }}" class="form-control number-separator @error('amount_collected') is-invalid @enderror">
@error('amount_collected')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
<label  class="required">{{ $fieldLabel }}</label>
