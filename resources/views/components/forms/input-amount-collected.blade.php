<input type="text"  wire:model="amount_collected" class="form-control number-separator @error('amount_collected') is-invalid @enderror">
@error('amount_collected')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
<label  class="required">Amount</label>


