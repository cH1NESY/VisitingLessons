<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Расписание преподавателя</title>
    <style>
        .lesson-actions {
            display: flex;
            gap: 5px;
            margin-top: 10px;
        }

        .lesson-actions form {
            margin: 0;
        }

        .btn-edit,
        .btn-delete {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 0.9em;
            display: inline-flex;
            align-items: center;
            gap: 3px;
        }

        .btn-edit {
            background-color: #f1c40f;
            color: #2c3e50;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }

        /* Стили для формы редактирования */
        .edit-form {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .edit-form .form-group {
            margin-bottom: 10px;
        }

        .edit-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .edit-form input,
        .edit-form select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 5px;
        }

        .edit-form-buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        /* Стили для кнопки "Старт пары" */
        .start-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #3498db;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .start-btn:hover {
            background-color: #2980b9;
        }

         * {
             margin: 0;
             padding: 0;
             box-sizing: border-box;
         }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            min-height: 100vh;
            background-color: #f5f5f5;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            margin-bottom: 20px;
            font-size: 1.5em;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar li {
            margin-bottom: 10px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .schedule-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .week-selector {
            display: flex;
            gap: 20px;
        }

        .week-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #3498db;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .week-btn.active {
            background-color: #2980b9;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .add-btn, .edit-btn, .delete-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .add-btn {
            background-color: #27ae60;
            color: white;
        }

        .add-btn:hover {
            background-color: #219a52;
        }

        .edit-btn {
            background-color: #f1c40f;
            color: #2c3e50;
        }

        .edit-btn:hover {
            background-color: #d4ac0d;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        .schedule {
            border-collapse: collapse;
            width: 100%;
        }

        .schedule th, .schedule td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .schedule th {
            background-color: #3498db;
            color: white;
        }

        .schedule tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .schedule tr:hover {
            background-color: #f5f5f5;
        }

        .time-cell {
            white-space: nowrap;
            color: #7f8c8d;
        }

        .room-cell {
            color: #e74c3c;
            font-weight: bold;
        }

        .groups-cell {
            color: #27ae60;
        }

        .hidden {
            display: none;
        }



        .modal.show {
            display: flex;
        }

        .action-cell {
            white-space: nowrap;
            width: 200px;
        }

        .row-action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9em;
            margin: 0 3px;
        }

        .edit-btn {
            background-color: #f1c40f;
            color: #2c3e50;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }

        .action-cell form {
            display: inline-block;
            margin: 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        /* Стили для раскрывающегося блока с подробной информацией */
        details {
            margin-bottom: 10px;
        }

        summary {
            cursor: pointer;
            font-weight: bold;
        }

        .lesson-details {
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
        }
        .action-cell {
            white-space: nowrap;
            width: 200px;
        }

        .row-action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9em;
            margin: 0 3px;
        }

        .edit-btn {
            background-color: #f1c40f;
            color: #2c3e50;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }

        .action-cell form {
            display: inline-block;
            margin: 0;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 5px;
            font-size: 1em;
            position: relative;
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeIn 0.5s ease forwards;
        }

        /* Анимация появления сообщений */
        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Стили для успешного сообщения */
        .alert-success {
            background-color: #d4edda; /* Светло-зеленый фон */
            border-color: #c3e6cb; /* Зеленая граница */
            color: #155724; /* Темно-зеленый текст */
        }

        /* Стили для сообщения об ошибке */
        .alert-danger {
            background-color: #f8d7da; /* Светло-красный фон */
            border-color: #f5c6cb; /* Красная граница */
            color: #721c24; /* Темно-красный текст */
        }

        /* Кнопка закрытия сообщения */
        .alert .close {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: inherit;
            font-size: 1.2em;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
        }

        .alert .close:hover {
            opacity: 0.8;
        }

        .qr-code-container {
            margin-top: 10px;
            text-align: center;
        }

        .qr-code-container img {
            max-width: 100%;
            height: auto;
        }

        .qr-sharing-container {
            margin-top: 15px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: white;
        }

        .sharing-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 15px;
        }

        .share-btn, .download-btn, .copy-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            gap: 8px;
            transition: background-color 0.3s;
        }

        .share-btn {
            background-color: #3498db;
            color: white;
        }

        .download-btn {
            background-color: #2ecc71;
            color: white;
        }

        .copy-btn {
            background-color: #95a5a6;
            color: white;
        }

        .share-btn:hover { background-color: #2980b9; }
        .download-btn:hover { background-color: #27ae60; }
        .copy-btn:hover { background-color: #7f8c8d; }

        /* Иконки */
        .share-icon, .download-icon, .copy-icon {
            width: 16px;
            height: 16px;
            display: inline-block;
            background-size: contain;
            background-repeat: no-repeat;

            .share-icon { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='white' viewBox='0 0 24 24'%3E%3Cpath d='M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92c0-1.61-1.31-2.92-2.92-2.92zM18 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM6 13c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm12 7.02c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z'/%3E%3C/svg%3E"); }
            .download-icon { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='white' viewBox='0 0 24 24'%3E%3Cpath d='M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z'/%3E%3C/svg%3E"); }
            .copy-icon { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='white' viewBox='0 0 24 24'%3E%3Cpath d='M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z'/%3E%3C/svg%3E"); }
    </style>

</head>
<body>
<div class="sidebar">
    <h2>Меню</h2>
    <ul>
        <li><a href="#" class="active">Расписание</a></li>
        <li><a href="#">Личный кабинет</a></li>
        <li><a href="#">Контакты</a></li>
    </ul>
</div>

<div class="main-content">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
            <button class="close" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
            <button class="close" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif
    <div class="schedule-container">
        <div class="controls">
            <div class="week-selector">
                <button class="week-btn {{ request()->input('week', 1) == 1 ? 'active' : '' }}"
                        onclick="window.location.href='{{ route('schedule', ['week' => 1]) }}'">
                    1-я неделя
                </button>
                <button class="week-btn {{ request()->input('week') == 2 ? 'active' : '' }}"
                        onclick="window.location.href='{{ route('schedule', ['week' => 2]) }}'">
                    2-я неделя
                </button>
            </div>
            <div class="action-buttons">
                <a href="{{ route('addLesson') }}" class="add-btn">
                    + Добавить пару
                </a>
            </div>
        </div>

        @php
            $days = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
            $currentWeek = request()->input('week', 1);
        @endphp

        <table class="schedule">
            <thead>
            <tr>
                <th>День недели</th>
                <th>Время</th>
                <th>Предмет</th>
                <th>Аудитория</th>
                <th>Группы</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @php
                $previousDay = null; // Переменная для хранения предыдущего дня недели
                $rowspanCount = 1;   // Счетчик для rowspan
            @endphp

            @foreach($days as $day)
                @php
                    $dayLessons = $lessons->where('week', $currentWeek)
                                         ->where('day_of_week', $day)
                                         ->sortBy('time');
                @endphp

                @if($dayLessons->count() > 0)
                    @foreach($dayLessons as $index => $lesson)
                        <tr>
                            @if($lesson->day_of_week !== $previousDay)
                                {{-- Если день недели не совпадает с предыдущим, выводим его и начинаем новый rowspan --}}
                                <td rowspan="{{ $dayLessons->count() }}">{{ $lesson->day_of_week }}</td>
                                @php
                                    $previousDay = $lesson->day_of_week; // Обновляем предыдущий день недели
                                @endphp
                            @endif

                            <td class="time-cell">{{ $lesson->time }}</td>
                                <td>
                                    <details>
                                        <summary>{{ $lesson->subject }}</summary>
                                        <div class="lesson-details">
                                            <p><strong>Аудитория:</strong> {{ optional($lesson->classroom)->number }}</p>
                                            <p><strong>Группы:</strong> {{ $lesson->groups }}</p>
                                            <div class="lesson-actions">
                                                <button class="start-btn" onclick="generateQRCode('{{ $lesson->id }}')">Старт пары</button>
                                                <div id="qr-sharing-container-{{ $lesson->id }}" class="qr-sharing-container" style="display: none;">
                                                    <div id="qr-code-{{ $lesson->id }}" class="qr-code-container"></div>
                                                    <div class="sharing-buttons">
                                                        <button onclick="shareQRCode('{{ $lesson->id }}')" class="share-btn">
                                                            <i class="share-icon"></i> Поделиться QR-кодом
                                                        </button>
                                                        <button onclick="downloadQRCode('{{ $lesson->id }}')" class="download-btn">
                                                            <i class="download-icon"></i> Скачать QR-код
                                                        </button>
                                                        <button onclick="copyAttendanceLink('{{ $lesson->id }}')" class="copy-btn">
                                                            <i class="copy-icon"></i> Копировать ссылку
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </details>
                                </td>
                            <td class="room-cell">{{ optional($lesson->classroom)->number }}</td>
                            <td class="groups-cell">{{ $lesson->groups }}</td>
                            <td class="action-cell">
                                <form action="{{ route('editLesson', $lesson->id) }}" method="GET" style="display: inline;">
                                    <button type="submit" class="row-action-btn edit-btn">✏️ Редактировать</button>
                                </form>
                                <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" style="display: inline;"
                                      onsubmit="return confirm('Вы уверены, что хотите удалить эту пару?');">

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="row-action-btn delete-btn">🗑️ Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Подключаем библиотеку QRCode.js -->
<script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>
<script>
    let qrCodeUrls = {};

    function generateQRCode(lessonId) {
        const container = document.getElementById(`qr-sharing-container-${lessonId}`);
        const qrCodeContainer = document.getElementById(`qr-code-${lessonId}`);
        container.style.display = 'block';
        qrCodeContainer.innerHTML = '';

        // Генерируем URL для страницы логина студента
        const loginUrl = `{{ route('student.login.form') }}?lesson_id=${lessonId}`;
        qrCodeUrls[lessonId] = loginUrl;

        new QRCode(qrCodeContainer, {
            text: loginUrl,
            width: 150,
            height: 150,
            correctLevel: QRCode.CorrectLevel.H
        });
    }

    async function shareQRCode(lessonId) {
        const url = qrCodeUrls[lessonId];

        if (navigator.share) {
            try {
                await navigator.share({
                    title: 'QR-код для отметки на паре',
                    text: 'Отсканируйте QR-код для отметки присутствия на паре',
                    url: url
                });
            } catch (error) {
                console.error('Ошибка при попытке поделиться:', error);
                alert('Не удалось поделиться QR-кодом. Попробуйте другой способ.');
            }
        } else {
            alert('Функция шеринга не поддерживается вашим браузером. Попробуйте скачать QR-код или скопировать ссылку.');
        }
    }

    function downloadQRCode(lessonId) {
        const qrCodeContainer = document.getElementById(`qr-code-${lessonId}`);
        const canvas = qrCodeContainer.querySelector('canvas');

        if (canvas) {
            const link = document.createElement('a');
            link.download = `qr-code-lesson-${lessonId}.png`;
            link.href = canvas.toDataURL('image/png');
            link.click();
        }
    }

    async function copyAttendanceLink(lessonId) {
        const url = qrCodeUrls[lessonId];

        try {
            await navigator.clipboard.writeText(url);
            alert('Ссылка успешно скопирована!');
        } catch (error) {
            console.error('Ошибка при копировании:', error);
            alert('Не удалось скопировать ссылку. Попробуйте вручную.');
        }
    }

    // Добавляем обработчик для закрытия QR-кода при клике вне контейнера
    document.addEventListener('click', function(event) {
        const containers = document.querySelectorAll('.qr-sharing-container');
        containers.forEach(container => {
            if (!container.contains(event.target) &&
                !event.target.classList.contains('start-btn')) {
                container.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>
