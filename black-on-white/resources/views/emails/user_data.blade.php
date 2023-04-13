<!DOCTYPE html>
<html>
<head>
    <title>Восстановление пароля</title>
</head>
<body>
<h1>Привет, {{ $user->name }}!</h1>
<p>Вы были зарегистрированны на сайте "Черным по белому". Ваши данные:</p>
<p>Логин: {{ $user->name }}</p>
<p>E-mail: {{ $user->email }}</p>
<p>Пароль: {{ $password }}</p>
</body>
</html>
