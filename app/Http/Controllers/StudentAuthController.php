<?php

namespace App\Http\Controllers;

use App\Models\LessonAttendance;
use Illuminate\Http\Request;


class StudentAuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        $lessonId = $request->get('lesson_id');
        return view('auth.studentLogin', compact('lessonId'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'group' => 'required',
            'lesson_id' => 'required'
        ]);

        // Создаем запись о посещении
        LessonAttendance::create([
            'lesson_id' => $request->lesson_id,
            'student_email' => $request->email,
            'student_name' => $request->name,
            'student_group' => $request->group,
            'check_in_time' => now()
        ]);

        return redirect()->route('attendance.success');
    }
}
