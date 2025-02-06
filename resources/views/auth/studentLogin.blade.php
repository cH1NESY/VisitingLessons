<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход для студента</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }
        .login-form {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        button {
            width: 100%;
            padding: 0.75rem;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }
        button:hover {
            background-color: #2980b9;
        }
        .location-status {
            margin-top: 1rem;
            padding: 0.5rem;
            border-radius: 4px;
            display: none;
        }
        .location-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .location-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .loading {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 0.5rem;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
<div class="login-form">
    <h2>Отметка о посещении пары</h2>
    <form id="attendanceForm" action="{{ route('student.login') }}" method="POST">
        @csrf
        <input type="hidden" name="lesson_id" value="{{ $lessonId }}">
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
        <input type="hidden" name="accuracy" id="accuracy">

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="name">ФИО:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="group">Группа:</label>
            <input type="text" id="group" name="group" required>
        </div>

        <div id="locationStatus" class="location-status">
            <span id="locationSpinner" class="loading"></span>
            <span id="locationMessage">Получение местоположения...</span>
        </div>

        <button type="submit" id="submitBtn" disabled>Отметиться</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('attendanceForm');
        const submitBtn = document.getElementById('submitBtn');
        const locationStatus = document.getElementById('locationStatus');
        const locationMessage = document.getElementById('locationMessage');
        const locationSpinner = document.getElementById('locationSpinner');

        // Функция обновления статуса местоположения
        function updateLocationStatus(message, type) {
            locationStatus.style.display = 'block';
            locationStatus.className = 'location-status location-' + type;
            locationMessage.textContent = message;
            locationSpinner.style.display = type === 'loading' ? 'inline-block' : 'none';
        }

        // Запрашиваем геолокацию при загрузке страницы
        if ("geolocation" in navigator) {
            updateLocationStatus('Получение местоположения...', 'loading');

            navigator.geolocation.getCurrentPosition(
                // Успешное получение геолокации
                function(position) {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                    document.getElementById('accuracy').value = position.coords.accuracy;

                    updateLocationStatus('Местоположение получено', 'success');
                    submitBtn.disabled = false;
                },
                // Ошибка получения геолокации
                function(error) {
                    let errorMessage;
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            errorMessage = "Вы должны разрешить доступ к местоположению для отметки присутствия.";
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMessage = "Информация о местоположении недоступна.";
                            break;
                        case error.TIMEOUT:
                            errorMessage = "Превышено время ожидания при получении местоположения.";
                            break;
                        default:
                            errorMessage = "Произошла ошибка при получении местоположения.";
                    }
                    updateLocationStatus(errorMessage, 'error');
                },
                // Опции геолокации
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        } else {
            updateLocationStatus('Ваш браузер не поддерживает определение местоположения', 'error');
        }

        // Обработка отправки формы
        form.addEventListener('submit', function(e) {
            if (!document.getElementById('latitude').value) {
                e.preventDefault();
                alert('Необходимо разрешить доступ к местоположению для отметки присутствия');
            }
        });
    });
</script>
</body>
</html>
