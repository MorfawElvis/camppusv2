<div>
    @section('title', 'Create Scholarships')
    <div class="card mt-4 mx-auto shadow-lg">
        <div class="card-header bg-primary">
            <i class="fas fa-arrow-alt-circle-down mr-2"></i>Create Scholarships
        </div>
        <div class="card-body">
            
        </div>
        <div class="card-footer">
           
        </div>
    </div>
    {{-- Subject Modal --}}
    <div class="modal fade" id="subjectModal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>{{ $editMode ? 'Edit Scholarship' : 'Create Scholarship' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   
                </div>
            </div>
        </div>
    </div>
</div>
