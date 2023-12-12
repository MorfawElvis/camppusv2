<div>
    @section('title', 'Student Fee Items')
    <div class="row">
        <div class="col-md-3">
            <x-card.card>
                <x-slot:header>Student Fee Items</x-slot:header>
                <x-slot:body>
                    <div class="nav flex-column nav-pills text-start">
                        <div wire:ignore>
                            <button  class="nav-link active earnings"  data-bs-toggle="tab" data-bs-target="#manage-items">
                                <i class="fas fa-money-bill me-2"></i>Manage Fee Items</button>
                            <button wire:click.prevent="loadExtraFeeComponent" class="nav-link"  data-bs-toggle="tab" data-bs-target="#create-items">
                                <i class="fas fa-money-check me-2"></i>Create Fee Items</button>
                        </div>
                    </div>
                </x-slot:body>
            </x-card.card>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                {{-- --}}
                <div class="tab-pane fade show active" id="manage-items" wire:ignore.self>
                    <x-card.card>
                        <x-slot:header>Manage Fee Items</x-slot:header>
                        <x-slot:body>
                            <div class="d-flex justify-content-center mt-2">
                                <div class="col-md-4">
                                    <select class="form-select" aria-label="class-select" wire:model="class_id">
                                        <option selected>Select Class</option>
                                        @foreach($class_rooms as $class)
                                            <option value="{{{ $class->id }}}">{{ $class->class_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('class_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-auto">
                                    <button wire:click.prevent="loadClassList" class="btn btn-primary mb-3 {{ $class_id ? '' : 'disabled' }}">
                                        <spn class="fas fa-redo me-2"></spn>Load List</button>
                                </div>
                            </div>
                            <hr>
                            {{-- --}}
                            <table class="table table-hover data-table mt-2">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Student</th>
                                    <th>Class</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                       <td colspan="4"  class="text-center">
                                           <div  wire:loading.delay wire:target="loadClassList">
                                               <span>Loading....</span>
                                           </div>
                                       </td>
                                   </tr>
                                 @if($students)
                                     @forelse($students as $student)
                                         <tr>
                                             <td>{{  $loop->iteration }}</td>
                                             <td>{{ $student->full_name }}</td>
                                             <td>{{ $student->class_room->class_name }}</td>
                                             <td class="text-center">
                                                 <button wire:click.prevent="showStudentFeeModal({{ $student }})" class="btn btn-outline-primary">View Fee Items</button>
                                             </td>
                                         </tr>
                                     @empty
                                         <x-table.record-not-found/>
                                     @endforelse
                                 @endif
                                </tbody>
                            </table>
                            {{--Modal to create student extra fee--}}
                            <x-modal.modal id="studentFeeModal" size="modal-lg" position="">
                                <x-slot:title>Managing Extra Fee Items For : {{ $student_name }} / {{ $student_class }} </x-slot:title>
                                <x-slot:body>
                                    <form wire:submit.prevent="{{ $editMode ? 'updateExtraFeeItem' : 'createExtraFeeItem' }}" class="row g-3 d-flex justify-content-center">
                                        <div class="col-auto">
                                            <select class="form-select" aria-label="class-select" wire:model.defer="extra_fee_id">
                                                <option selected>Select Fee Item</option>
                                                @foreach($extra_fee_items as $fee_item)
                                                    <option value="{{{ $fee_item->id }}}">{{ $fee_item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('extra_fee_id')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-auto">
                                            <label for="extra_fee_amount" class="visually-hidden">Amount</label>
                                            <input type="text" class="form-control number-separator @error('extra_fee_amount') is-invalid @enderror"
                                                   wire:model.defer="extra_fee_amount" id="extra_fee_amount" placeholder="Amount">
                                            @error('extra_fee_amount')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary mb-3"><spn class="fas fa-plus me-2"></spn>{{ $editMode ? 'Save Changes' : 'Create' }}</button>
                                        </div>
                                    </form>
                                    <hr>
                                    <x-table.table :headers="['S/N','Fee Item','Amount','']">
                                        @php
                                            $total_extra_fee = 0;
                                        @endphp
                                        @if($student_withXFees)
                                            @forelse($student_withXFees as $extra_fee)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $extra_fee->name }}</td>
                                                    <td>{{ number_format($extra_fee->pivot->amount ?? $extra_fee_amount) }}</td>
                                                    <td>
                                                        <button wire:click.prevent="deleteExtraFeeItem({{ $extra_fee->id }})"><i class="fas fa-times-circle text-bold text-danger cursor-pointer"></i></button>
                                                    </td>
{{--                                                    @php--}}
{{--                                                        $payable_fee += $fee_item->amount--}}
{{--                                                    @endphp--}}
                                                </tr>
                                            @empty
                                                <x-table.record-not-found/>
                                            @endforelse
                                        @endif
{{--                                        <caption class="text-dark text-right mt-2">Total Payable Fee: <span class="text-bold">{{ number_format($payable_fee) . ' XAF' }}</span></caption>--}}
                                    </x-table.table>

                                </x-slot:body>
                            </x-modal.modal>
                        </x-slot:body>
                    </x-card.card>
                </div>

                <div class="tab-pane fade" id="create-items" wire:ignore.self>
                    <x-card.card>
                        <x-slot:header>Create Fee Items</x-slot:header>
                        <x-slot:body>
                            {{-- --}}
                           @livewire('finance.extra-fee-items')
                        </x-slot:body>
                    </x-card.card>
                </div>
            </div>
        </div>
    </div>
</div>
@push('page-scripts')
    <script>
       window.addEventListener('showStudentFeeModal',  event => {
           $('#studentFeeModal').modal('show')
       })
    </script>
@endpush

