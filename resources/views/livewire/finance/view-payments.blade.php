<div>
    @section('title', 'View Payments')
    <div class="card mt-4 mx-auto shadow-lg">
        <div class="card-header">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" wire:ignore>
            <li class="nav-item" role="presentation">
            <button class="nav-link  fw-bold active" id="students-tab" data-bs-toggle="tab" data-bs-target="#students" type="button" role="tab" aria-controls="students" aria-selected="true">Students</button>
            </li>
            <li class="nav-item" role="presentation">
            <button class="nav-link  fw-bold" id="class-tab" data-bs-toggle="tab" data-bs-target="#class" type="button" role="tab" aria-controls="class" aria-selected="false">Class</button>
            </li>
        </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="students" role="tabpanel" aria-labelledby="students-tab" wire:ignore.self>
                    <table class="table table-striped table-hover table-responsive-lg">
                        <div class="row mb-3 g-3">
                            <div class="col-lg-8">
                                <input type="text" wire:model.debounce.300ms="search" class="form-control" placeholder="Search name or matriculation number">
                            </div>
                            <div class="ms-auto col-lg-2">
                                <select class="form-select" wire:model="perPage">
                                    <option value="10" selected>10</option>
                                    <option value="15">15</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                  </select>
                            </div>
                        </div>
                        <caption class="mt-2">{{ $student_fees->links() }}</caption>
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Student's Name</th>
                            {{-- <th>Section</th> --}}
                            <th>Class</th>
                            <th class="text-center">Payable Fee</th>
                            <th class="text-center">Amount Paid</th>                   
                            <th class="text-center">Discount</th>                   
                            <th class="text-center">Balance Owed</th> 
                            {{-- <th class="text-center">Status</th>                     --}}
                            <th class="text-center">Actions</th>                    
                        </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                        @endphp
                        @forelse ($student_fees as $student_fee)
                        <tr>
                            @php
                                $discount = 0;
                                if (isset($student_fee->scholarship->scholarship_category->discount)) {
                                    $discount = $student_fee->scholarship->scholarship_category->discount;
                                }
                            @endphp
                            <td>{{ $student_fees->firstItem() + $loop->index }}</td>
                            <td>{{ $student_fee->full_name }}</td>
                            {{-- <td>{{ $student_fee->class_room->section->section_name }}</td> --}}
                            <td>{{ $student_fee->class_room->class_name }}</td>
                            @if ($student_fee->is_boarding)
                             <td class="text-center">{{ number_format($student_fee->class_room->payable_fee + $get_boarding_fee->boarding_fee ) }}</td>
                             @else
                             <td class="text-center">{{ number_format($student_fee->class_room->payable_fee)}}</td>
                            @endif 
                            <td class="text-center">{{ number_format($student_fee->payments_sum_amount) }}</td>
                            <td class="text-center">{{ number_format($discount) }}</td>
                            @if ($student_fee->is_boarding)
                              <td class="text-center">{{ number_format(($student_fee->class_room->payable_fee + $get_boarding_fee->boarding_fee) - ($student_fee->payments_sum_amount + $discount)) }}</td>
                             @else
                              <td class="text-center">{{ number_format($student_fee->class_room->payable_fee - ($student_fee->payments_sum_amount + $discount)) }}</td>
                            @endif
                            {{-- <td class="text-center"><span class="badge {{ ($student_fee->class_room->payable_fee - $student_fee->payments_sum_amount) == 0 && $student_fee->payments_sum_amount > 0 ? 'bg-success' : 'bg-warning'}}
                                ">{{ ($student_fee->class_room->payable_fee - $student_fee->payments_sum_amount) == 0 && $student_fee->payments_sum_amount > 0 ? 'Completed' : 'Incomplete'}}
                            </span>
                            </td> --}}
                            <td class="text-center">
                                <span><a href="{{ url('/school-fee-statement', [$student_fee->id]) }}" class="btn btn-xs btn-success"><i class="fas fa-print mr-2"></i>Statement</a></span>
                                <span><a wire:click.prevent="showFeePaymentModal({{ $student_fee->id }})" class="btn btn-xs btn-success"><i class="fas fa-hand-holding-usd mr-2"></i>Collect Fee</a></span>
                            </td>
                        </tr>
                        @empty
                        <tr  class="text-center">
                            <td colspan="9"><i class="fas fa-question-circle mr-2"></i>No record found</td>
                        </tr>            
                        @endforelse
                        </tbody>
                    </table>   
                </div>
                <div class="tab-pane fade" id="class" role="tabpanel" aria-labelledby="class-tab" wire:ignore.self>
                    <table class="table table-striped table-hover table-responsive-lg">
                        <caption>{{ $class_fees->links() }}</caption>
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Class</th>
                            <th class="text-center">Enrollment</th>
                            <th class="text-center">Payable Fee</th>
                            <th class="text-center">Total Expected Collected</th>
                            <th class="text-center">Total Fee Collected</th>                   
                            <th class="text-center">% Fee Collected</th>                   
                            <th class="text-center">Actions</th>                   
                        </tr>
                        </thead>
                        <tbody>
                         @forelse ($class_fees as $class_fee )
                         <tr>
                            <td>{{ $class_fees->firstItem() + $loop->index }}</td>
                            <td>{{ $class_fee->class_name }}</td>
                            <td class="text-center">{{ $class_fee->students_count }}</td>
                            <td class="text-center">{{ number_format($class_fee->payable_fee) }}</td>
                            <td class="text-center">{{ number_format($class_fee->students_count * $class_fee->payable_fee) }}</td>
                            <td class="text-center">{{ number_format($class_fee->payments_sum_amount) }}</td>
                            @if ($class_fee->payments_sum_amount != 0)
                            <td class="text-center"><span class="badge bg-success">
                                {{ round(($class_fee->payments_sum_amount/($class_fee->students_count * $class_fee->payable_fee))*100, 2) . '%' }}</span></td>
                                @else
                                <td class="text-center"><span class="badge bg-danger">0.00%</span></td>
                            @endif     
                            <td class="text-center">
                                <span><a href="{{ url('/bulk-fee-statement', [$class_fee->id]) }}" class="btn btn-xs btn-primary"><i class="fas fa-print mr-2"></i>Statements</a></span>
                                <span><a href="{{ url('/class-fee-summary',  [$class_fee->id]) }}" class="btn btn-xs btn-primary"><i class="fas fa-print mr-2"></i>Summary</a></span>
                            </td>
                        </tr>   
                         @empty
                             <tr  class="text-center">
                                <td colspan="8"><i class="fas fa-question-circle mr-2"></i>No record found</td>
                             </tr>            
                         @endforelse 
                        </tbody>
                    </table>
                </div>    
            </div>
        </div>
    </div>
    <div class="modal fade" id="FeePaymentModal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>New Fee Entry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="newFeePayment">
                            <div class="form-floating mb-4">
                                <input type="text"  class="form-control" value="{{ number_format($balance_owed) }}" disabled>
                                <label  class="required">Balanced Owed</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text"  wire:model="amount_collected" class="form-control number-separator @error('amount_collected') is-invalid @enderror">
                                @error('amount_collected')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <label  class="required">Amount</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="date" wire:model='transaction_date' class="form-control @error('transaction_date') is-invalid @enderror">
                                @error('transaction_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>  
                                @enderror
                                <label class="required" for="floatingInput">Transaction Date</label>
                            </div>
                            <div>
                                <div class="float-right">
                                    <button type="button" class="btn btn-warning rounded-pill mr-2" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit"  class="btn btn-primary rounded-pill" {{ $buttonDisabled ? 'disabled' : 'enabled' }}>
                                        <div wire:loading.delay wire:target="submit" class="spinner-border spinner-border-sm text-white"></div>
                                        Save 
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('page-scripts')
<script>
    window.addEventListener('showFeePaymentModal', event => {
        $('#FeePaymentModal').modal('show');
    });
    window.addEventListener('hideFeePaymentModal', event => {
        $('#FeePaymentModal').modal('hide');
    });
</script>  
@endpush
