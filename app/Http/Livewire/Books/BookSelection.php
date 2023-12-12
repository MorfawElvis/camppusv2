<?php

namespace App\Http\Livewire\Books;

use App\Models\ClassRoom;
use Livewire\Component;
use App\Models\Book;
use App\Models\Student;

class BookSelection extends Component
{
    public $selectedClass;
    public $selectedStudent;
    public $selectedBooks = [];

    public function render()
    {
        $classes = ClassRoom::where('academic_year_id', current_school_year()->id)->get();
        $students = Student::where('class_room_id', $this->selectedClass)->get();
        $books = Book::all();

        return view('livewire.books.book-selection', compact('classes', 'students', 'books'));
    }

    public function updatedSelectedClass()
    {
        $this->selectedStudent = null;
        $this->selectedBooks = [];
    }

    public function updatedSelectedStudent()
    {
        // You can implement logic to load previously selected books for the student here
        $this->selectedBooks = [];
    }

    public function saveSelection()
    {
        $selectedBooks = $this->selectedBooks;

        dd($selectedBooks);
    }
}

