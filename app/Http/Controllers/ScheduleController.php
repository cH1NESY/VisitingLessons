<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;


class ScheduleController extends Controller
{
    public function showSchedule()
    {
        return view('schedule');
    }

    public function index(Request $request)
    {
        $week = $request->input('week', 1);
        $lessons = Lesson::with('classroom')
            ->where('week', $week)
            ->orderBy('day_of_week')
            ->orderBy('time')
            ->get();

//        dd([
//            'week' => $week,
//            'lessons_count' => $lessons->count(),
//            'lessons' => $lessons->toArray()
//        ]);

        return view('schedule', compact('lessons'));
    }



    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return redirect()->route('schedule')
            ->with('success', 'Пара успешно удалена');
    }


}
