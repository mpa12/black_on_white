<!DOCTYPE html>
<html>
<head>
    <title>Восстановление пароля</title>
</head>
<body>
<h1>Привет, {{ $user->name }}!</h1>
<p>Был отправлен запрос на восстановление пароля пользователя {{ $user->name }}.</p>
<p>Если это были не вы, то просто проигнорируйте письмо</p>
<p><a href="{{ $href }}">Ссылка для восстановления пароля</a></p>
</body>
</html>
