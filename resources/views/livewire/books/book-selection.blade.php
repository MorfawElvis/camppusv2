<div>
    <!-- resources/views/livewire/book-selection.blade.php -->

    <div>
        <form wire:submit.prevent="saveSelection">
            <div class="mb-3">
                <label for="selectedClass" class="form-label">Select Class</label>
                <select wire:model="selectedClass" class="form-select">
                    <option value="">Select Class</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="selectedStudent" class="form-label">Select Student</label>
                <select wire:model="selectedStudent" class="form-select">
                    <option value="">Select Student</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->full_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="selectedBooks" class="form-label">Select Books</label>
                @foreach($books as $book)
                    <div class="form-check">
                        <input wire:model="selectedBooks" class="form-check-input" type="checkbox" value="{{ $book->id, $book->title, $book->price }}">
                        <label class="form-check-label">{{ $book->title }} - {{ $book->price }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Save Selection</button>
        </form>
    </div>

</div>
