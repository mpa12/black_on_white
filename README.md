# SPA веб-приложение для студенческого театра "Черным по белому"

## Черным по белому

Студенческий театр «Чёрным по белому» был основан в 2019 году в Хабаровском колледже отраслевых технологий и сферы обслуживания.
Руководитель: Юлия Владимировна Пирюткина

Название – «Чёрным по белому» – выбрано не случайно. Фразеологизм чёрным по белому означает «совершенно ясно, чётко, определённо». И это значит, что мы постараемся сделать наши спектакли понятными и интересными для зрителя.

Стилистика театра также предполагает наличие только двух цветов – чёрного и белого. Декорации и реквизит выполнены, в основном, в белом цвете, что помогает, с одной стороны, расширить пространство небольшой сцены колледжа, с другой стороны, акцентировать внимание зрителей на фигурах актёров или тенях. Кроме того, чёрно-белая гамма позволяет сделать костюмы и декорации универсальными.

Ещё одной особенностью спектаклей является наличие элементов театра теней. Тени (картонных фигурок или фигур самих актёров) проецируются на специальный экран из белой ткани – изображение получается буквально «чёрным по белому».

## Стек технологий

1. Laravel 9.x
2. Vue.js 3.3.0
3. Bootstrap 5.3
4. Docker
5. Composer

## Инструкция по развертыванию

1. Перейти через консоль в папку с проектом
2. Ввести команду docker-compose up -d
3. Ввести команду docker ps
4. После запуска педыдущей команды должна появиться таблица из которой надо скопировать CONTAINER_ID нашего приложения
5. docker exec -it CONTAINER_ID bash
6. composer install
7. php artisan migrate
8. Готово!

## Пример .env

APP_NAME=Laravel

APP_ENV=local

APP_KEY=base64:Q/np1t+YNbwjxmKFrrGHCdGhTSVM6CQWp891g2G6VQ0=

APP_DEBUG=true

APP_URL=http://localhost

LOG_CHANNEL=stack

LOG_DEPRECATIONS_CHANNEL=null

LOG_LEVEL=debug

DB_CONNECTION=mysql

DB_HOST=mysql

DB_PORT=3306

DB_DATABASE=black_on_white

DB_USERNAME=sail

DB_PASSWORD=password

BROADCAST_DRIVER=log

CACHE_DRIVER=file

FILESYSTEM_DISK=local

QUEUE_CONNECTION=sync

SESSION_DRIVER=file

SESSION_LIFETIME=120

MEMCACHED_HOST=memcached

REDIS_HOST=redis

REDIS_PASSWORD=null

REDIS_PORT=6379

MAIL_MAILER=smtp

MAIL_HOST=mailpit

MAIL_PORT=1025

MAIL_USERNAME=null

MAIL_PASSWORD=null

MAIL_ENCRYPTION=null

MAIL_FROM_ADDRESS="hello@example.com"

MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=

AWS_SECRET_ACCESS_KEY=

AWS_DEFAULT_REGION=us-east-1

AWS_BUCKET=

AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=

PUSHER_APP_KEY=

PUSHER_APP_SECRET=

PUSHER_HOST=

PUSHER_PORT=443

PUSHER_SCHEME=https

PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"

VITE_PUSHER_HOST="${PUSHER_HOST}"

VITE_PUSHER_PORT="${PUSHER_PORT}"

VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"

VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

JWT_SECRET=k0kY2TXmbPIRrwXGeF1mk0ychcRMU6WxSanGZEc08uIlw2vDHan7AVIwAm8oVzbZ

JWT_ALGO=HS256
