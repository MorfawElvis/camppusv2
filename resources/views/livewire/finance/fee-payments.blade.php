<div>
    @section('title', 'Fee Payments')
    <div class="card mt-4 mx-auto shadow-lg">
        <div class="card-header bg-primary">
            <i class="fas fa-arrow-alt-circle-down mr-2"></i>Fee Payments
        </div>
        <div class="card-body">
            <div class="d-flex mb-3">
                <div class="p-2 fw-bold">Date Search</div>
                <div>
                    <input class="form-control" type="date" wire:model="search">
                </div>
                <div class="ms-auto p-2">
                    <a wire:click.prevent="showFeePaymentModal" class="btn btn-outline-primary rounded-pill float-end" id="add-button">
                        <i class="fas fa-plus-circle mr-2"></i>New Entry</a>
                </div>
              </div>
            <table class="table table-striped table-hover table-responsive-lg">
                <caption class="mt-2">{{ $fee_payments->links() }}</caption>
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Student's Name</th>
                    <th>Section</th>
                    <th>Class</th>
                    <th class="text-center">Amount Paid</th>
                    <th class="text-center">Transaction Date</th>                   
                    <th class="text-center">Actions</th>                   
                </tr>
                </thead>
                <tbody>
                @forelse ($fee_payments as $fee_payment)
                <tr>
                    <td>{{ $fee_payments->firstItem() + $loop->index }}</td>
                    <td>{{ $fee_payment->student->full_name }}</td>
                    <td>{{ $fee_payment->student->class_room->section->section_name }}</td>
                    <td>{{ $fee_payment->student->class_room->class_name }}</td>
                    <td class="text-center">{{ number_format($fee_payment->amount) . ' XAF'}}</td>
                    <td class="text-center">{{ $fee_payment->transaction_date }}</td>
                    <td class="text-center">
                        <span><a href="{{ url('/school-fee-receipt', [$fee_payment->id]) }}"  class="btn btn-xs btn-primary"><i class="fas fa-print mr-2"></i>Print Receipt</a></span>
                        <span><a class="btn btn-xs btn-danger "><i class="fas fa-trash mr-1"></i>Delete</a></span>
                    </td>
                </tr>
                @empty
                <tr  class="text-center">
                    <td colspan="7"><i class="fas fa-question-circle mr-2"></i>No record found</td>
                </tr>            
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- Subject Modal --}}
    <div class="modal fade" id="FeePaymentModal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>New Fee Entry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="newFeePayment">
                        <div class="form-floating mb-3">
                            <select wire:model.lazy="section_id" class="form-select" required>
                              <option selected>Open this select menu</option>
                              @foreach ($sections as $section )
                              <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                              @endforeach
                            </select>
                            <label for="floatingSelect">Section</label>
                        </div>
                        @if (!is_null($class_rooms))
                            <div class="form-floating mb-3">
                                <select wire:model.lazy="class_id" class="form-select" required>
                                <option selected>Open this select menu</option>
                                @foreach ($class_rooms as $class_room )
                                   <option value="{{ $class_room->id }}">{{ $class_room->class_name }}</option>
                                @endforeach
                                </select>
                                <label for="floatingSelect">Class</label>
                            </div>
                        @endif
                        @if (!is_null($students))
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" wire:model.lazy="student_id" required>
                              <option selected>Open this select menu</option>
                              @foreach ($students as $student)
                              <option value="{{ $student->id }}">{{ $student->full_name }}</option>
                              @endforeach
                            </select>
                            <label for="floatingSelect">Name of Student</label>
                        </div>
                        @endif
                        @if (!is_null($student_id))
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
                                <input type="date" wire:model='transaction_date' class="form-control @error('transaction_date') is-invalid @enderror" required>
                                <label class="required" for="floatingInput">Transaction Date</label>
                              </div>
                        @endif
                        <div>
                            <div wire:loading>
                                Please wait....
                            </div>
                            <div class="float-right">
                                <button type="button" class="btn btn-warning rounded-pill mr-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit"  class="btn btn-primary rounded-pill" {{ $buttonDisabled ? 'disabled' : 'enabled' }}>
                                    <div wire:loading.delay wire:target="submit" class="spinner-border spinner-border-sm text-white"></div>
                                    Save Entry
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
