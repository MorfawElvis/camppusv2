<?php

namespace App\Http\Livewire\Timetable;

use App\Models\TeachingPeriod;
use App\Models\TimetableSetting;
use App\Models\Weekday;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Dompdf\Dompdf;
use Dompdf\Options;

class ManagePeriod extends Component
{
    use LivewireAlert;

    public $start_time;
    public $period_duration;
    public $number_of_periods;
    public $number_of_breaks = 0;
    public $breaks = [];
    public $periods = [];
    public $durations = [];
    public $successMessage = '';
    public $isLoading = false;

    public $editing = false;
    public $editPeriodId;
    public $editPeriodName;
    public $editPeriodStartTime;
    public $editPeriodEndTime;
    public $editPeriodType;

    public $weekdays;
    public $start_day_id;
    public $end_day_id;
    public $weekdaySuccessMsg = false;

    public function mount()
    {
        $this->initializeBreaks();
        $this->initializeWeekdays();
    }

    private function initializeBreaks()
    {
        $this->breaks = [];
        for ($i = 0; $i < $this->number_of_breaks; $i++) {
            $this->breaks[] = [
                'name' => '',
                'after_period' => 0,
                'duration' => 0,
            ];
        }
    }

    private function initializeWeekdays()
    {
        $this->weekdays = Weekday::orderBy('order')->get();
        $setting = TimetableSetting::first();
        if ($setting) {
            $this->start_day_id = $setting->start_day_id;
            $this->end_day_id = $setting->end_day_id;
        }
    }

    public function saveSettings()
    {
        $this->validate([
            'start_day_id' => 'required|exists:weekdays,id',
            'end_day_id' => 'required|exists:weekdays,id|after_or_equal:start_day_id',
        ]);

        TimetableSetting::updateOrCreate(['id' => 1], [
            'start_day_id' => $this->start_day_id,
            'end_day_id' => $this->end_day_id,
        ]);
        $this->weekdaySuccessMsg = true;
        session()->flash('message', 'Settings saved successfully.');
    }

    public function updatedNumberOfBreaks()
    {
        $this->initializeBreaks();
    }

    public function generatePeriods()
    {
        $this->validate([
            'start_time' => 'required|date_format:H:i',
            'period_duration' => 'required|integer|min:1',
            'number_of_periods' => 'required|integer|min:1',
            'breaks.*.name' => 'required|string',
            'breaks.*.after_period' => 'required|integer|min:1',
            'breaks.*.duration' => 'required|integer|min:0',
        ]);

        $this->isLoading = true;

        try {
            $this->periods = [];
            $this->durations = [$this->period_duration];
            $current_time = Carbon::createFromFormat('H:i', $this->start_time);
            $break_index = 0;

            for ($i = 1; $i <= $this->number_of_periods; $i++) {
                $start_time = $current_time->format('H:i');
                $end_time = $current_time->copy()->addMinutes($this->period_duration)->format('H:i');

                $this->periods[] = [
                    'name' => $this->ordinal($i) . ' Period',
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'type' => 'teaching',
                    'id' => $i, // Dummy ID for editing
                ];

                $current_time->addMinutes($this->period_duration);

                if ($break_index < $this->number_of_breaks && $i == $this->breaks[$break_index]['after_period']) {
                    $this->periods[] = [
                        'name' => $this->breaks[$break_index]['name'],
                        'start_time' => $current_time->format('H:i'),
                        'end_time' => $current_time->copy()->addMinutes($this->breaks[$break_index]['duration'])->format('H:i'),
                        'type' => 'break',
                        'id' => null, // No ID for breaks
                    ];
                    $current_time->addMinutes($this->breaks[$break_index]['duration']);
                    $break_index++;
                }
            }

            $this->savePeriods();
            $this->alert('success', 'Periods generated successfully!');
            $this->resetInputFields();
        } catch (\Exception $e) {
            $this->alert('error', 'Failed to generate periods: ' . $e->getMessage());
        } finally {
            $this->isLoading = false;
        }
    }

    private function resetInputFields()
    {
        $this->start_time = '';
        $this->period_duration = '';
        $this->number_of_periods = '';
        $this->number_of_breaks = 0;
        $this->initializeBreaks();
    }

    public function savePeriods()
    {
        TeachingPeriod::truncate(); // Clear existing periods

        foreach ($this->periods as $period) {
            TeachingPeriod::create([
                'name' => $period['name'],
                'start_time' => $period['start_time'],
                'end_time' => $period['end_time'],
                'type' => $period['type'],
            ]);
        }
    }

    public function editPeriod($id)
    {
        $period = TeachingPeriod::find($id);

        if ($period) {
            $this->editPeriodId = $period->id;
            $this->editPeriodName = $period->name;
            $this->editPeriodStartTime = $period->start_time;
            $this->editPeriodEndTime = $period->end_time;
            $this->editPeriodType = $period->type;

            $this->editing = true;
        }
    }

    public function updatePeriod()
    {
        $this->validate([
            'editPeriodName' => 'required|string',
            'editPeriodStartTime' => 'required|date_format:H:i',
            'editPeriodEndTime' => 'required|date_format:H:i',
            'editPeriodType' => 'required|string|in:teaching,break',
        ]);

        $period = TeachingPeriod::find($this->editPeriodId);

        if ($period) {
            $period->update([
                'name' => $this->editPeriodName,
                'start_time' => $this->editPeriodStartTime,
                'end_time' => $this->editPeriodEndTime,
                'type' => $this->editPeriodType,
            ]);

            $this->editing = false;
            $this->resetEditFields();
        }
    }

    private function resetEditFields()
    {
        $this->editPeriodId = null;
        $this->editPeriodName = '';
        $this->editPeriodStartTime = '';
        $this->editPeriodEndTime = '';
        $this->editPeriodType = '';
    }

    private function ordinal($number)
    {
        $suffixes = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
        if ((($number % 100) >= 11) && (($number % 100) <= 13)) {
            return $number . 'th';
        } else {
            return $number . $suffixes[$number % 10];
        }
    }

    public function generatePDF()
    {
        $periods = TeachingPeriod::all()->toArray();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);

        $view = View::make('prints.teaching_periods', ['periods' => $periods]);
        $dompdf->loadHtml($view->render());

        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('teaching_periods_schedule.pdf');
    }

    public function render()
    {
        $periods = TeachingPeriod::all();

        // Convert periods to an array format for Blade
        $periodsArray = $periods->isNotEmpty() ? $periods->toArray() : [];
        $durations = [$this->period_duration]; // Adjust if multiple durations are used
        return view('livewire.timetable.manage-period', compact('periodsArray', 'durations'));
    }
}
