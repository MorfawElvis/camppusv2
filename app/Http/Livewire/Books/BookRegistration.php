<?php

namespace App\Http\Livewire\Books;

use Livewire\Component;
use App\Models\ClassRoom;
use App\Models\Book;

class BookRegistration extends Component
{
    public $classId;
    public $newBookTitle;
    public $bulkBookTitles = [];

    public function render()
    {
        $classes = ClassRoom::where('academic_year_id', current_school_year()->id)->get();
        $books = Book::where('class_room_id', $this->classId)->get();
        return view('livewire.books.book-registration', compact('classes', 'books'));
    }

    public function registerBook()
    {
        // Validate and save the single book entry
        $this->validate([
            'newBookTitle' => 'required|string|max:255',
        ]);

        Book::create([
            'class_room_id' => $this->classId,
            'title' => $this->newBookTitle,
            'author' => 'Elvis Morfaw',
            'price' => 2750,
            // Add other relevant book details
        ]);

        $this->reset();
    }

    public function registerBulkBooks()
    {
        // Validate and save the bulk book entries
        $this->validate([
            'bulkBookTitles.*' => 'required|string|max:255',
        ]);

        foreach ($this->bulkBookTitles as $title) {
            Book::create([
                'class_id' => $this->classId,
                'title' => $title,
                // Add other relevant book details
            ]);
        }

        $this->reset(['bulkBookTitles']);
    }
}

