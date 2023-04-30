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
7. php artisan migrate (Если нужны тестовые данные, то надо добавить ключ --seed)
8. Выйти из контейнера используя команду exit
9. Ввести команду ./vendor/bin/sail npm install
10. Ввести команду ./vendor/bin/sail npm run dev
11. Готово!
