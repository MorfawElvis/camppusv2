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
                        <div class="d-flex mb-3">
                            <div class="col-4">
                                <input type="text" wire:model.debounce.300ms="search" class="form-control" placeholder="Search student">
                            </div>
                            <div class="ms-auto col-1">
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
                            <th>Section</th>
                            <th>Class</th>
                            <th class="text-center">Payable Fee</th>
                            <th class="text-center">Amount Paid</th>                   
                            <th class="text-center">Balance Owed</th> 
                            <th class="text-center">Status</th>                    
                            <th class="text-center">Actions</th>                    
                        </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                        @endphp
                        @forelse ($student_fees as $student_fee)
                        <tr>
                            <td>{{ $student_fees->firstItem() + $loop->index }}</td>
                            <td>{{ $student_fee->full_name }}</td>
                            <td>{{ $student_fee->class_room->section->section_name }}</td>
                            <td>{{ $student_fee->class_room->class_name }}</td>
                            <td class="text-center">{{ number_format($student_fee->class_room->payable_fee) }}</td>
                            <td class="text-center">{{ number_format($student_fee->payments_sum_amount) }}</td>
                            <td class="text-center">{{ number_format($student_fee->class_room->payable_fee - $student_fee->payments_sum_amount) }}</td>
                            <td class="text-center"><span class="badge {{ ($student_fee->class_room->payable_fee - $student_fee->payments_sum_amount) == 0 && $student_fee->payments_sum_amount > 0 ? 'bg-success' : 'bg-warning'}}
                                ">{{ ($student_fee->class_room->payable_fee - $student_fee->payments_sum_amount) == 0 && $student_fee->payments_sum_amount > 0 ? 'Completed' : 'Incomplete'}}
                            </span>
                            </td>
                            <td class="text-center">
                                <span><a href="{{ url('/school-fee-statement', [$student_fee->id]) }}" class="btn btn-xs btn-success"><i class="fas fa-print mr-2"></i>Print Statement</a></span>
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
                                <span><a class="btn btn-xs btn-primary"><i class="fas fa-print mr-2"></i>Print Statement</a></span>
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
</div>
