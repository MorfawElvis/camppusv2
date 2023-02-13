<div>
    @section('title', 'Fee Collected Report')
    <div class="card mt-4 mx-auto shadow-lg">
        <div class="card-header bg-primary">
            <i class="fas fa-arrow-alt-circle-down mr-2"></i>Fee Collected Report
        </div>
        <div class="card-body">
               <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="dateFrom" class="col-form-label">Date From</label>
                            </div>
                            <div class="col-auto col-lg-4">
                            <input type="date" id="dateFrom" class="form-control" wire:model="date_from">
                            </div>
                            <div class="col-auto">
                                <label for="dateTo" class="col-form-label">Date To</label>
                            </div>
                            <div class="col-auto col-lg-4">
                                <input type="date" id="dateTo" class="form-control" wire:model="date_to">
                            </div>
                            <div class="col-auto">
                              @if($date_from !== null && $date_to !== null && $fee_payments->total() !== 0)
                                 <a wire:click="printReport"  class="btn btn-primary"><i class="fas fa-print me-2"></i>Print Report</a> 
                              @endif
                        </div>   
               </div>
              <div class="table-responsive">
                <table class="table table-striped table-hover mt-3">
                    <caption class="mt-2">{{ $fee_payments->links() }}</caption>
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Student's Name</th>
                        <th>Section</th>
                        <th>Class</th>
                        <th class="text-center">Amount Paid</th>
                        <th class="text-center">Transaction Date</th>                                  
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($fee_payments as $fee_payment)
                        <tr>
                            <td>{{ $fee_payments->firstItem() + $loop->index }}</td>
                            <td>{{ $fee_payment->student->full_name ?? 'Student deleted or Dismissed' }}</td>
                            <td>{{ $fee_payment->student->class_room->section->section_name ?? '' }}</td>
                            <td>{{ $fee_payment->student->class_room->class_name ?? '' }}</td>
                            <td class="text-center">{{ number_format($fee_payment->amount) . ' XAF'}}</td>
                            <td class="text-center">{{ $fee_payment->transaction_date }}</td>
                        </tr>
                        @empty
                        <tr  class="text-center">
                            <td colspan="6"><i class="fas fa-question-circle mr-2"></i>No record found</td>
                        </tr>            
                        @endforelse
                    </tbody>
                </table>
              </div>
        </div>
    </div>
  
</div>
