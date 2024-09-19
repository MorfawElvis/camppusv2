<?php
namespace App\Http\Livewire\Timetable;

use App\Models\ClassSubjectAssignment;
use App\Models\EmployeeSubject;
use App\Models\TimetableSetting;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\ClassRoom;
use App\Models\TeachingPeriod;
use App\Models\Timetable;
use App\Models\Weekday;
use Illuminate\Support\Facades\DB;

class ManageTimetable extends Component
{
    use LivewireAlert;
    public $classRoomId;
    public $timetables = [];
    public $error = null;
    public $levelId;

    protected $rules = [
        'classRoomId' => 'required|exists:class_rooms,id',
    ];

    public function generateTimetable()
    {
        $classRoom = ClassRoom::find($this->classRoomId);
        if (!$classRoom) {
            $this->alert('error', 'Classroom not found.');
            return;
        }

        $this->levelId = $classRoom->level_id;

        // Find all classrooms with the same level ID
        $classRooms = ClassRoom::where('level_id', $this->levelId)->get();

        DB::beginTransaction();

        try {
            foreach ($classRooms as $classRoom) {
                // Clear existing timetables for this class
                Timetable::where('class_room_id', $classRoom->id)->delete();

                // Get all subjects for the class and eager load the 'subject' relationship
                $classSubjects = ClassSubjectAssignment::with('subject')
                    ->where('class_room_id', $classRoom->id)
                    ->get();

                // Initialize an array to track assigned periods for each subject
                $subjectAssignments = [];
                foreach ($classSubjects as $assignment) {
                    $subject = $assignment->subject;
                    $subjectAssignments[$subject->id] = [
                        'subject' => $subject,
                        'assigned_periods' => 0,
                        'required_periods' => $assignment->teaching_periods_per_week
                    ];
                }

                $availableSlots = [];
                $weekdays = Weekday::all();
                $teachingPeriods = TeachingPeriod::where('type', 'teaching')->get();

                // Populate available slots, excluding reserved periods
                foreach ($weekdays as $weekday) {
                    foreach ($teachingPeriods as $period) {
                        // Check if the period is reserved for non-teaching activities
                        if ($this->isReservedPeriod($weekday, $period)) {
                            continue; // Skip reserved periods
                        }

                        $availableSlots[] = [
                            'day_of_week' => $weekday->id,
                            'period_number' => $period->id,
                            'start_time' => $period->start_time,
                            'end_time' => $period->end_time
                        ];
                    }
                }

                // Shuffle slots to ensure randomness
                shuffle($availableSlots);

                // Assign subjects to slots
                foreach ($subjectAssignments as &$subjectAssignment) {
                    foreach ($availableSlots as $slotIndex => $slot) {
                        if ($subjectAssignment['assigned_periods'] < $subjectAssignment['required_periods']) {
                            // Ensure no conflict with other classes in the same level
                            $conflict = Timetable::where('level_id', $this->levelId)
                                ->where('day_of_week', $slot['day_of_week'])
                                ->where('period_number', $slot['period_number'])
                                ->exists();

                            if (!$conflict) {
                                // Ensure no day conflict within the same class
                                $dayConflict = Timetable::where('class_room_id', $classRoom->id)
                                    ->where('day_of_week', $slot['day_of_week'])
                                    ->where('period_number', $slot['period_number'])
                                    ->exists();

                                if (!$dayConflict) {
                                    // Assign the subject to this slot
                                    Timetable::create([
                                        'class_room_id' => $classRoom->id,
                                        'subject_id' => $subjectAssignment['subject']->id,
                                        'level_id' => $this->levelId,
                                        'day_of_week' => $slot['day_of_week'],
                                        'period_number' => $slot['period_number'],
                                        'start_time' => $slot['start_time'],
                                        'end_time' => $slot['end_time']
                                    ]);

                                    $subjectAssignment['assigned_periods']++;

                                    // Remove the used slot to prevent re-use
                                    unset($availableSlots[$slotIndex]);

                                    // Break the loop to move to the next subject
                                    break;
                                }
                            }
                        }
                    }

                    // If after all slots, the required periods aren't assigned, throw an error
                    if ($subjectAssignment['assigned_periods'] < $subjectAssignment['required_periods']) {
                        DB::rollBack();
                        $this->alert('error', "Failed to assign all periods for subject: {$subjectAssignment['subject']->subject_name} in class {$classRoom->class_name}. Please check for scheduling conflicts.");
                        return;
                    }
                }
            }

            DB::commit();
            $this->alert('success', 'Timetables generated successfully for all classes in this level.');
            $this->emit('timetableUpdated');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error generating timetable: ' . $e->getMessage());
            $this->alert('error', 'An unexpected error occurred while generating the timetable. Please check the logs for details.');
        }
    }

    private function isReservedPeriod($weekday, $period)
    {
        // Implement logic to check if a period is reserved for non-teaching activities like "Morning Devotion" or "Break"
        // This could be done by checking a specific flag or value in the `TeachingPeriod` model or another configuration.
        return false;
    }

    public function render()
    {
        $timetabledClasses = Timetable::select('class_room_id')->distinct()->get()->pluck('class_room_id');
        $classesWithTimetables = ClassRoom::whereIn('id', $timetabledClasses)->get();

        return view('livewire.timetable.manage-timetable', [
            'weekdays' => Weekday::orderBy('order')->get(),
            'periods' => TeachingPeriod::all(),
            'classes' => ClassRoom::all(),
            'classesWithTimetables' => $classesWithTimetables
        ]);
    }
}

