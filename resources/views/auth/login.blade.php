<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #003366;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
            align-items: center; /* Centering the labels and inputs */
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            max-width: 300px; /* Set maximum width for inputs */
            width: 100%; /* Full width up to max-width */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #003366;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            max-width: 300px; /* Set maximum width for the button */
            margin-top: 10px; /* Add some space above the button */
        }
        button:hover {
            background-color: #00509e;
        }
        .error-messages {
            background-color: #ffdddd;
            color: #d8000c;
            border: 1px solid #d8000c;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .register-link {
            margin-top: 15px; /* Space above the registration link */
            text-align: center; /* Center the link text */
        }
        .register-link a {
            text-decoration: none;
            color: #003366; /* Link color */
        }
        .register-link a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
</head>
<body>
<h1>Вход</h1>

@if ($errors->any())
    <div class="error-messages">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <form action="{{ route('postLogin') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            <button type="submit">Войти</button>
        </div>
        <div class="register-link">
            <p>Нет аккаунта? <a href="{{ route('getRegister') }}">Зарегистрируйтесь</a></p>
        </div>
    </form>
</div>
</body>
</html>
