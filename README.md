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

1. Устаноливаем зависимости указанные в файле composer.json
```
composer install
```

2. Создаем файл .env по примеру из .env.example

3. Запускаем контейнеры

```
./vendor/bin/sail up -d
```

4. Запускаем миграции

```
./vendor/bin/sail php artisan migrate
```

5. Устаноливаем зависимости указанные в файле package.json

```
./vendor/bin/sail npm install
```

6. Выполняем сборку на основе настроек, указанных в файле package.json

```
./vendor/bin/sail npm run build
```
