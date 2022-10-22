<div class="form-check form-switch">
    <input wire:click="termStatusChange({{ $academic_term->id }}, '{{ $academic_term->term_status }}')" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
           @if($academic_term->term_status == 'opened') checked @endif>
    <label class="form-check-label" for="flexSwitchCheckChecked"></label>
</div>
