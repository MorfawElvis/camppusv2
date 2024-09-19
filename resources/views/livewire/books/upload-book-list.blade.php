<form wire:submit.prevent="upload" class="p-2">
    <div class="row">
        <div class="col-12 col-md-4 mb-3">
            <label for="classRoom" class="form-label">Select Class</label>
            <select wire:model="classRoomId" id="classRoom" class="form-control" required>
                <option value="">-- Select Class --</option>
                @foreach($classRooms as $classRoom)
                    <option value="{{ $classRoom->id }}">{{ $classRoom->class_name }}</option>
                @endforeach
            </select>
            @error('classRoomId') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-4 mb-3">
            <label for="bookList" class="form-label">Upload Book List (Excel)</label>
            <input type="file" wire:model="bookList" id="bookList" class="form-control">
            @error('bookList') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-4 mb-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-50">Upload</button>
        </div>
    </div>
</form>
<hr>
<div class="mt-5">
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Class</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($classesWithBookLists as $index => $class)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $class->class_name }}</td>
                <td>
                    <button wire:click="generateBookList({{ $class->id }})" class="btn btn-sm btn-primary">Print Book List</button>
                    <button wire:click="downloadBookCollectionForm({{ $class->id }})" class="btn btn-sm btn-secondary">Print Book Collection Form</button>
                    <button onclick="confirmDelete({{ $class->id }})" class="btn btn-sm btn-danger">Delete</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">No classes with book lists yet.</td>
            </tr>
        @endforelse
    </table>
</div>
<script>
    function confirmDelete(classRoomId) {
        if (confirm('Are you sure you want to delete this book list? This action cannot be undone.')) {
            @this.call('deleteBookList', classRoomId);
        }
    }
</script>
