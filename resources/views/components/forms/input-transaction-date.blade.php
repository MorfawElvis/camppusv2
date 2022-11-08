<input type="date" wire:model='transaction_date' class="form-control @error('transaction_date') is-invalid @enderror">
@error('amount_collected')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
<label class="required" for="floatingInput">Transaction Date</label>