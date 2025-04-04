<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\Storage;

class ScheduleController extends Controller
{
    public function create() {
        return view('administration.schedule.create');
    }

    public function save(Request $request)
    {
        $request->validate([
            'schedule' => 'required|array',
            'schedule.*.date' => 'required|date',
            'schedule.*.start_time' => 'required|date_format:H:i',
            'schedule.*.end_time' => 'required|date_format:H:i|after:schedule.*.start_time',
        ]);

        $adminId = auth()->id();

        foreach ($request->schedule as $item) {
            Schedule::create([
                'admin_id' => $adminId,
                'date' => $item['date'],
                'start_time' => $item['start_time'],
                'end_time' => $item['end_time'],
            ]);
        }

        return response()->json(['message' => 'Schedule saved successfully.']);
}
}


?>