<?php

namespace App\Imports;

use App\Models\SchoolYear;
use App\Models\Textbook;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BookListImport implements ToModel, WithHeadingRow
{
    protected int $classRoomId;

    public function __construct($classRoomId)
    {
        $this->classRoomId = $classRoomId;
    }

    public function model(array $row): Textbook
    {
        return new Textbook([
            'subject_category' => $row['subject_category'],
            'title' => $row['title'],
            'author' => $row['author'],
            'publisher' => $row['publisher'],
            'price' => $row['price'],
            'academic_year_id' => SchoolYear::where('year_status', 'opened')->first()->id,
            'class_room_id' => $this->classRoomId,
        ]);
    }
}
