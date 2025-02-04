<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{


    public function getAddLesson(){
        $classrooms = Classroom::all();

        return view('addLesson', compact('classrooms'));

    }

    public function store(Request $request)
    {

        // Валидация данных
        $validated = $request->validate([
            'week' => 'required|integer|in:1,2',
            'day_of_week' => 'required|string',
            'time' => 'required|string',
            'subject' => 'required|string',
            'classroom_id' => 'required|exists:classrooms,id',
            'groups' => 'required|string',
        ]);


            // Создание записи в базе данных
        Lesson::create($validated);

        return redirect()->route('schedule')
            ->with('success', 'Пара успешно добавлена в расписание');



    }

    public function edit(Lesson $lesson)
    {
        $classrooms = Classroom::all();
        return view('editLesson', compact('lesson', 'classrooms'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'week' => 'required|integer|in:1,2',
            'day_of_week' => 'required|string',
            'time' => 'required|string',
            'subject' => 'required|string',
            'classroom_id' => 'required|exists:classrooms,id',
            'groups' => 'required|string',
        ]);



        $lesson->update($validated);



        return redirect()->route('schedule')->with('success', 'Пара успешно обновлена');
    }

    public function destroy($id)
    {
        try {
            $lesson = Lesson::findOrFail($id);
            $lesson->delete();
            return redirect()->route('schedule')->with('success', 'Пара успешно удалена.');
        } catch (\Exception $e) {
            return redirect()->route('schedule')->with('error', 'Не удалось удалить пару.');
        }
    }

    public function startLesson(Request $request)
    {
        // Получаем данные из запроса
        $lessonData = $request->only([
            'lesson_id',
            'subject',
            'classroom',
            'groups',
            'time'
        ]);

        // Здесь можно сохранить данные в сессию или обработать их
        session(['current_lesson' => $lessonData]);

        // Перенаправляем на страницу активной пары
        return view('active-lesson', compact('lessonData'));
    }
}
