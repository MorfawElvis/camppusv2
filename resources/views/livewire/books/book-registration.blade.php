<div>
    <!-- resources/views/livewire/book-registration.blade.php -->

    <div>
        <form wire:submit.prevent="registerBook">
            <div class="mb-3">
                <label for="classId" class="form-label">Select Class</label>
                <select wire:model="classId" class="form-select">
                    <option value="">Select Class</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="newBookTitle" class="form-label">Enter Single Book Title</label>
                <input wire:model="newBookTitle" type="text" class="form-control" placeholder="Book Title">
                @error('newBookTitle') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Register Single Book</button>
        </form>

        <hr>
        <form wire:submit.prevent="registerBulkBooks">
            <div class="mb-3">
                <label for="bulkBookTitles" class="form-label">Enter Bulk Book Titles (comma-separated)</label>
                <textarea wire:model="bulkBookTitles" class="form-control" placeholder="Book Title 1, Book Title 2, ..."></textarea>
                @error('bulkBookTitles.*') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Register Bulk Books</button>
        </form>

        <hr>

        @if($classId)
            <h3>Registered Books for Class: {{ $classId }}</h3>
            <ul>
                @foreach($books as $book)
                    <li>{{ $book->title }}</li>
                @endforeach
            </ul>
        @endif
    </div>

</div>
