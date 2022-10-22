<div>
    @section('title', 'Manage Levels')
    <div class="card mt-4 mx-auto shadow-lg">
        <div class="card-header bg-primary">
            <i class="fas fa-arrow-alt-circle-down mr-2"></i>Manage Levels
        </div>
        <div class="card-body">
            <a wire:click.prevent="showLevelsModal" class="btn btn-outline-primary rounded-pill float-right mb-2" id="add-button">
                <i class="fas fa-plus-circle mr-2"></i>Create Level</a>
            <table class="table table-striped table-hover table-responsive-lg">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Level Name</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($levels as $level)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $level->level_name }}</td>
                        <td class="text-center">
                            <span><a wire:click.prevent="editModal({{ $level }})" class="btn btn-xs btn-primary" ><i class="fas fa-edit mr-1"></i>Edit</a></span>
                            <span><a wire:click.prevent="confirmDeleteLevel({{ $level->id }})" class="btn btn-xs btn-danger " ><i class="fas fa-trash mr-1"></i>Delete</a></span>
                        </td>
                    </tr>
                @empty
                    <tr  class="text-center">
                        <td colspan="3"><i class="fas fa-question-circle mr-2"></i>No record found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="links">

            </div>
        </div>
    </div>
    {{-- levels modal --}}
    <div class="modal fade" id="levelsModal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>{{ $editMode ? 'Edit Level' : 'Create Level' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{$editMode ? 'editLevel' : 'createLevel'}}" class="form-floating">
                        <div class="form-floating mb-3">
                            <input type="text" wire:model.lazy="levelName" class="form-control @error('levelName') is-invalid @enderror"
                                   placeholder="Enter Level">
                            @error('levelName')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label  class="required">Level Name</label>
                            <small>For example Form one</small>
                        </div>
                        <div class="form-floating mb-4">
                            <select class="form-select @error('levelRank') is-invalid @enderror" wire:model.lazy="levelRank" {{ $editMode ? 'disabled' : 'enabled' }}>
                                <option value="" selected>Open this select menu</option>
                                @foreach($rank_options  as $rank_option)
                                    <option value="{{$rank_option}}">{{$rank_option}}</option>
                                @endforeach
                            </select>
                            @error('levelRank')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label class="required">Level Rank</label>
                            <small>For example Rank 1, for Form one</small>
                        </div>
                        <x-modal-buttons>{{$editMode ? 'Save Changes' : 'Save Record'}}</x-modal-buttons>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--/ levels modal end --}}
</div>
@push('page-scripts')
    <script>
        window.addEventListener('showLevelsModal', event => {
            $('#levelsModal').modal('show')
        })
        window.addEventListener('hideLevelsModal', event => {
            $('#levelsModal').modal('hide')
        })
    </script>
@endpush
