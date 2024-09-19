<div>
    @section('title', 'Timetable Setting')
    <div class="row">
        <div class="col-md-3">
            <x-card.card>
                <x-slot:header>Timetable Settings</x-slot:header>
                <x-slot:body>
                    <div class="nav flex-column nav-pills text-start">
                        <div wire:ignore>
                            <button class="nav-link active periods"  data-bs-toggle="tab" data-bs-target="#generatePeriods">
                                <i class="fas fa-money-bill me-2"></i>Generate Teaching Periods</button>
                            <button class="nav-link periods"  data-bs-toggle="tab" data-bs-target="#viewPeriods">
                                <i class="fas fa-money-bill me-2"></i>View Teaching Periods</button>
                            <button class="nav-link"  data-bs-toggle="tab" data-bs-target="#weekdays">
                                <i class="fas fa-money-check me-2"></i>Manage Weekdays</button>
                        </div>
                    </div>
                </x-slot:body>
            </x-card.card>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="generatePeriods" wire:ignore.self>
                    <x-card.card>
                        <x-slot:header>Generate Periods</x-slot:header>
                        <x-slot:body>
                            <div class="alert alert-warning mt-2">
                                <strong>Warning:</strong> Generating new periods will clear the existing periods and may affect the timetable if subjects have already been assigned. Please ensure you have reviewed and saved any necessary data before proceeding.
                            </div>
                            <form wire:submit.prevent="generatePeriods" class="container">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="start_time" class="form-label">Start Time</label>
                                        <input type="time" id="start_time" wire:model="start_time" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="period_duration" class="form-label">Period Duration (minutes)</label>
                                        <input type="number" id="period_duration" wire:model="period_duration" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="number_of_periods" class="form-label">Number of Periods</label>
                                        <input type="number" id="number_of_periods" wire:model="number_of_periods" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="number_of_breaks" class="form-label">Number of Breaks</label>
                                        <input type="number" id="number_of_breaks" wire:model="number_of_breaks" class="form-control">
                                    </div>
                                </div>
                                @foreach($breaks as $index => $break)
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="break_name_{{ $index }}" class="form-label">Break {{ $index + 1 }} Name</label>
                                            <input type="text" id="break_name_{{ $index }}" wire:model="breaks.{{ $index }}.name" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="break_after_period_{{ $index }}" class="form-label">Break {{ $index + 1 }} After Period</label>
                                            <input type="number" id="break_after_period_{{ $index }}" wire:model="breaks.{{ $index }}.after_period" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="break_duration_{{ $index }}" class="form-label">Break {{ $index + 1 }} Duration (minutes)</label>
                                            <input type="number" id="break_duration_{{ $index }}" wire:model="breaks.{{ $index }}.duration" class="form-control">
                                        </div>
                                    </div>
                                @endforeach
                                <button type="submit" class="btn btn-primary my-3 float-right">
                                    Generate Periods
                                    @if ($isLoading)
                                        <span class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true"></span>
                                    @endif
                                </button>
                            </form>
                        </x-slot:body>
                    </x-card.card>
                </div>
                <div class="tab-pane fade" id="viewPeriods" wire:ignore.self>
                    <x-card.card>
                        <x-slot:header>View Periods</x-slot:header>
                        <x-slot:body>
                            <div class="float-right my-3">
                                <form action="{{ route('generate-teaching-periods-pdf') }}" method="GET" target="_blank">
                                    <button type="submit" class="btn btn-primary">Generate Periods Template</button>
                                </form>
                            </div>
                            @if (!empty($periodsArray))
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>Teaching Period</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Duration</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($periodsArray as $period)
                                        <tr>
                                            <td>
                                                @if($period['type'] !== 'teaching')
                                                    <strong>{{ $period['name'] }}</strong>
                                                @else
                                                    {{ $period['name'] }}
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($period['start_time'])->format('h:i A') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($period['end_time'])->format('h:i A') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($period['start_time'])->diffInMinutes(\Carbon\Carbon::parse($period['end_time'])) }} mins</td>
                                            <td>
                                                <button wire:click="editPeriod({{ $period['id'] }})" class="btn btn-warning btn-sm">Edit</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif

                        </x-slot:body>
                    </x-card.card>
                </div>
                <div class="tab-pane fade" id="weekdays" wire:ignore.self>
                    <x-card.card>
                        <x-slot:header>Manage Weekdays</x-slot:header>
                        <x-slot:body>
                            @if($weekdaySuccessMsg)
                                <x-alert-success></x-alert-success>
                            @endif
                            <form wire:submit.prevent="saveSettings" class="row gy-2 gx-5 align-items-center mx-4 my-4 d-flex justify-content-center">
                                <div class="col-auto">
                                    <label for="start_day_id">Start Day</label>
                                    <select id="start_day_id" wire:model="start_day_id" class="form-select">
                                        <option value="">Select Start Day</option>
                                        @foreach ($weekdays as $day)
                                            <option value="{{ $day->id }}">{{ $day->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('start_day_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-auto">
                                    <label for="end_day_id">End Day</label>
                                    <select id="end_day_id" wire:model="end_day_id" class="form-select">
                                        <option value="">Select End Day</option>
                                        @foreach ($weekdays as $day)
                                            <option value="{{ $day->id }}">{{ $day->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('end_day_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-auto">
                                    <button type="submit" id="save-button"  class="btn btn-primary rounded-pill mt-4">Save Record</button>
                                </div>
                            </form>
                        </x-slot:body>
                    </x-card.card>
                </div>
            </div>
        </div>
    </div>
    @if ($editing)
        <div class="modal fade show" style="display: block; padding-right: 17px;" tabindex="-1" role="dialog" aria-labelledby="editPeriodModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPeriodModalLabel">Edit Period</h5>
                        <button type="button" class="close" wire:click="$set('editing', false)" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="updatePeriod">
                            <div class="form-group">
                                <label for="editPeriodName">Period Name</label>
                                <input type="text" class="form-control" id="editPeriodName" wire:model.defer="editPeriodName" required>
                            </div>
                            <div class="form-group">
                                <label for="editPeriodStartTime">Start Time</label>
                                <input type="time" class="form-control" id="editPeriodStartTime" wire:model.defer="editPeriodStartTime" required>
                            </div>
                            <div class="form-group">
                                <label for="editPeriodEndTime">End Time</label>
                                <input type="time" class="form-control" id="editPeriodEndTime" wire:model.defer="editPeriodEndTime" required>
                            </div>
                            <div class="form-group">
                                <label for="editPeriodType">Period Type</label>
                                <select class="form-control" id="editPeriodType" wire:model.defer="editPeriodType" required>
                                    <option value="teaching">Teaching</option>
                                    <option value="break">Break</option>
                                </select>
                            </div>
                           <div class="float-right">
                               <button type="submit" class="btn btn-primary">Update Period</button>
                               <button type="button" class="btn btn-secondary" wire:click="$set('editing', false)">Cancel</button>
                           </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

