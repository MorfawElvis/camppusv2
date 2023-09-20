<button type="button" wire:click.prevent="{{ $event }}"  class="btn btn-outline-primary rounded-pill float-right mb-3">
    <i class="fas fa-plus-circle mr-2"></i>
    {{ $slot }}
</button>
