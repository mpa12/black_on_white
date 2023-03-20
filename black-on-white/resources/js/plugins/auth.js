export default async function checkAuth() {
    // Проверяем, есть ли JWT-токен в localStorage
    const token = localStorage.getItem('token');
    if (!token) {
        return false
    }

    try {
        // Добавляем текущий JWT-токен в заголовок Authorization
        const config = {
            headers: { Authorization: `Bearer ${token}` }
        };

        // Отправляем POST-запрос на маршрут API для обновления токена
        await axios.post('/api/auth/refresh', null, config).then(response => {
            localStorage.setItem('token', response.data.user.api_token);
        })

        // Если запрос успешный, значит пользователь авторизован
        return true;
    } catch (error) {
        // Если запрос вернул ошибку, значит пользователь не авторизован
        return false;
    }
}
