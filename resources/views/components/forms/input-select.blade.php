@props(['disabled' => false, 'options' => [], 'selected' => null, 'default' => null, 'selected_id', 'selected_value'])
<div class="form-floating mb-4">
    <select id="{{ $fieldName }}" class="form-select @error($fieldName) is-invalid @enderror" wire:model="{{ $fieldName }}">
        @if ($editMode ?? '')
            <option value="{{ $selected_id }}" selected>{{ $selected_value }}</option>
        @else
            <option selected>Open this select menu</option>
        @endif
        @foreach($options as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
    @error($fieldName)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
    <label for="{{ $fieldName }}" class="required">{{ __($fielLabel) }}</label>
</div>
