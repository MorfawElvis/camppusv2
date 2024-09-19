<div>
    @section('title', 'Manage Book List')
    <div class="row">
        <div class="col-md-3">
            <x-card.card>
                <x-slot:header>Manage Book List</x-slot:header>
                <x-slot:body>
                    <div class="nav flex-column nav-pills text-start">
                        <div wire:ignore>
                            <button class="nav-link active uploadBookList"  data-bs-toggle="tab" data-bs-target="#uploadBookList">
                                <i class="fas fa-arrow-right me-2"></i>Upload Book List</button>
                            <button class="nav-link"  data-bs-toggle="tab" data-bs-target="#bookBills">
                                <i class="fas fa-arrow-right me-2"></i>View Book Bills</button>
                            <button class="nav-link"  data-bs-toggle="tab" data-bs-target="#reports">
                                <i class="fas fa-arrow-right me-2"></i>Print Reports</button>
                        </div>
                    </div>
                </x-slot:body>
            </x-card.card>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="uploadBookList" wire:ignore.self>
                    <x-card.card>
                        <x-slot:header>Upload Book List</x-slot:header>
                        <x-slot:body>
                             @livewire('books.upload-book-list')
                        </x-slot:body>
                    </x-card.card>
                </div>
                <div class="tab-pane fade" id="bookBills" wire:ignore.self>
                    <x-card.card>
                        <x-slot:header>View Book Bills</x-slot:header>
                        <x-slot:body>

                        </x-slot:body>
                    </x-card.card>
                </div>
                <div class="tab-pane fade" id="reports" wire:ignore.self>
                    <x-card.card>
                        <x-slot:header>Print Reports</x-slot:header>
                        <x-slot:body>

                        </x-slot:body>
                    </x-card.card>
                </div>
            </div>
        </div>
    </div>
</div>



