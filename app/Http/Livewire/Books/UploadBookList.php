<?php

namespace App\Http\Livewire\Books;

use App\Imports\BookListImport;
use App\Models\ClassRoom;
use App\Models\SchoolYear;
use Barryvdh\DomPDF\Facade\Pdf;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class UploadBookList extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $bookList;
    public $classRoomId;

    protected $listeners = ['bookListDeleted' => '$refresh'];

    protected $rules = [
        'bookList' => 'required|file|mimes:xlsx,xls',
        'classRoomId' => 'required|exists:class_rooms,id',
    ];

    public function upload()
    {
        $this->validate();

        if ($this->classRoomId && $this->bookList){
            Excel::import(new BookListImport($this->classRoomId), $this->bookList->getRealPath());
        }
        $this->alert('success', 'Book list uploaded successfully.');
        $this->reset(['bookList']);
    }

    public function deleteBookList($classRoomId)
    {
        $classRoom = ClassRoom::with('textbooks')->findOrFail($classRoomId);
        $classRoom->textbooks()->delete();
        session()->flash('message', 'Book list deleted successfully.');
        $this->emit('bookListDeleted');
    }
    public function render()
    {
        $classesWithBookLists = ClassRoom::whereHas('textbooks')->get();
        return view('livewire.books.upload-book-list',  [
            'classRooms' => \App\Models\ClassRoom::all(),
            'classesWithBookLists' => $classesWithBookLists,
        ]);
    }
}
