<?php

namespace App\Http\Livewire\Books;

use App\Models\ClassRoom;
use App\Models\GeneralSetting;
use App\Models\SchoolYear;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class ManageBookList extends Component
{

    public function downloadBookCollectionForm($classRoomId)
    {
        $classRoom = ClassRoom::with(['students', 'textbooks'])->findOrFail($classRoomId);
        $academicYear = SchoolYear::where('year_status', 'opened')->first()->year_name;
        $schoolName = GeneralSetting::first()->school_name;

        $pdf = Pdf::loadView('pdf.book-collection-form', [
            'classRoom' => $classRoom,
            'academicYear' => $academicYear,
            'schoolName' => $schoolName,
        ]);
        return $pdf->download("BookCollectionForm_Class_{$classRoom->class_name}.pdf");
    }

    public function generateBookList($classRoomId): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $classRoom = ClassRoom::with('textbooks')->findOrFail($classRoomId);
        $schoolName = 'Your School Name'; // or fetch from a setting
        $academicYear = '2024/2025'; // or fetch dynamically

        $pdf = Pdf::loadView('pdf.bookList', [
            'schoolName' => $schoolName,
            'academicYear' => $academicYear,
            'className' => $classRoom->class_name,
            'textbooks' => $classRoom->textbooks
        ]);

        return response()->streamDownload(
            fn () => print($pdf->output()),
            "BookList_{$classRoom->class_name}.pdf"
        );
    }
    public function render()
    {
        return view('livewire.books.manage-book-list');
    }
}
