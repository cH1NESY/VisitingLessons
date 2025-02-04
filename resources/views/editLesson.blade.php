<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать пару</title>
    <style>
        /* Сохраняем тот же CSS что и в add-lesson.html */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 500px;
            max-width: 90%;
        }

        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-header h2 {
            margin: 0;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #2c3e50;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .cancel-btn {
            background-color: #f1c40f;
            color: #2c3e50;
        }

        .cancel-btn:hover {
            background-color: #d4ac0d;
        }

        .save-btn {
            background-color: #27ae60;
            color: white;
        }

        .save-btn:hover {
            background-color: #219a52;
        }
    </style>
</head>
<body>
<div class="form-container">
    <div class="form-header">
        <h2>Редактировать пару</h2>
    </div>
    <form id="lessonForm" method="POST" action="{{ route('updateLesson', $lesson->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="weekSelect">Неделя</label>
            <select id="weekSelect" name="week" required>
                <option value="1" {{ $lesson->week == 1 ? 'selected' : '' }}>1-я неделя</option>
                <option value="2" {{ $lesson->week == 2 ? 'selected' : '' }}>2-я неделя</option>
            </select>
        </div>
        <div class="form-group">
            <label for="daySelect">День недели</label>
            <select id="daySelect" name="day_of_week" required>
                @foreach(['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница'] as $day)
                    <option value="{{ $day }}" {{ $lesson->day_of_week == $day ? 'selected' : '' }}>{{ $day }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="timeSelect">Время</label>
            <select id="timeSelect" name="time" required>
                @foreach(['8:30 - 10:00', '10:10 - 11:40', '12:10 - 13:40', '14:10 - 15:40'] as $time)
                    <option value="{{ $time }}" {{ $lesson->time == $time ? 'selected' : '' }}>{{ $time }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="subject">Предмет</label>
            <input type="text" id="subject" name="subject" required value="{{ $lesson->subject }}">
        </div>
        <div class="form-group">
            <label for="roomSelect">Аудитория</label>
            <select id="roomSelect" name="classroom_id" required>
                @foreach ($classrooms as $classroom)
                    <option value="{{ $classroom->id }}" {{ $lesson->classroom_id == $classroom->id ? 'selected' : '' }}>
                        {{ $classroom->number }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="groups">Группы</label>
            <input type="text" id="groups" name="groups" required value="{{ $lesson->groups }}" placeholder="Например: ИСТ-201, ИСТ-202">
        </div>
        <div class="form-actions">
            <a href="{{ route('schedule') }}" class="btn cancel-btn">Отмена</a>
            <button type="submit" class="btn save-btn">Сохранить изменения</button>
        </div>
    </form>
</div>
</body>
</html>
