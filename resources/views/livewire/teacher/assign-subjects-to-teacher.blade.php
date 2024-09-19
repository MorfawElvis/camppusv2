<div>
    @section('title', 'Assign Subjects to Teachers')
        <div class="card mx-auto shadow-lg">
            <div class="card-header bg-primary">
                <i class="fas fa-cogs mr-2"></i>
                Assign Subjects to Teachers
            </div>
            <div class="card-body">
                <x-table.table :headers="['Teacher','Subjects','Edit Subjects']">
                    @forelse($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->full_name }}</td>
                            <td>
                                @foreach ($teacher->subjects as $subject)
                                    <span class="badge badge-info">{{ $subject->subject_name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" wire:click="openModal({{ $teacher->id }})">Edit Subjects</button>
                            </td>
                        </tr>
                    @empty
                        <x-table.record-not-found/>
                    @endforelse
                    <caption>{{ $teachers->links() }}</caption>
                </x-table.table>
            </div>
        </div>
    @if ($showModal)
        <div class="modal modal-l d-block">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Assign Subjects to {{ $selected_teacher->full_name }}</h5>
                        <button type="button" class="close" wire:click="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="assignSubjects">
                            <div class="form-group">
                                <div class="row">
                                    @foreach ($subjects->chunk(5) as $chunk)
                                        <div class="col-md-6">
                                            @foreach($chunk as $subject)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" wire:model="selected_subjects" value="{{ $subject->id }}" id="subject_{{ $subject->id }}">
                                                    <label class="form-check-label" for="subject_{{ $subject->id }}">
                                                        {{ $subject->subject_name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @error('selected_subjects') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

