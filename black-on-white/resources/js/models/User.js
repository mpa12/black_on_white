class User {
    /**
     * Получение текущего токена авторизации
     * @returns {string}
     */
    static getCurrentToken = () => localStorage.getItem('token');

    /**
     * Получение строки JWT-токеном
     * @param token
     * @returns {"Bearer null"}
     */
    static getAuthorizationString = (token = null) => {
        if (!token) token = this.getCurrentToken();
        return `Bearer ${token}`;
    }

    /**
     * Проверка пользователя на роль админа
     * @returns {boolean}
     */
    static async isAdmin() {
        const token = this.getCurrentToken();

        if (!token) return Promise.resolve(false);

        const url = '/api/auth/is-admin';
        const config = {
            headers: { Authorization: this.getAuthorizationString(token) }
        };

        return axios.get(url, config)
            .then(response => !!response.data)
            .catch(() => false);
    }

    /**
     * Проверка пользователя на гостя
     * @returns {boolean}
     */
    static isGuest = () => !this.getCurrentToken();

    /**
     * Проверка пользователя на авторизацию
     * @returns {boolean}
     */
    static isAuth = () => !!this.getCurrentToken();

    static logout = () => {
        localStorage.removeItem('token');
    }

    static login = api_token => {
        localStorage.setItem('token', api_token);
    }
}

export default User;
