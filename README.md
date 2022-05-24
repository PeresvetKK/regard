## WEBPACK 5

## ⚙️ Стек

- Webpack 5
- Babel
- devServer
- eslint
- prettier

## Команды

- npm run start - запуск dev сервера
- npm run build - создание билда
- npm run deploy - загрузка файлов на фтп сервер (для загрузки на сервер необходимо заполнить .env файл и выполнить команду "npm run deploy")

## Инструкции

При созданнии новой страницы необходимо выполнить команду npm run create pageName (где pageName - название будущей страницы) либо выполнить следующие пункты:

- Создать в папке src файл html
- Создать в папке js одноименный файл js
- Подключить css стили и необходимые html компоненты в созданный js файл

## Предупреждения

- В html файлах НЕ ДОЛЖНЫ БЫТЬ подключены какие-либо скрипты (при запуске сервера или создании билда, сборщик сам подключает одноименный js скрипт в КАЖДОМ html файле, который находится в папке src)
- Стили, написанные вручную, подключаются тоже через js (сборщик опять же подключает одноименный css файл в КАЖДОМ html файле, который находится в папке src)
- Все модули и библиотеки подключаются через npm и импортятся в нужные js файлы
- В папке img, независимо от вложенности, не должны быть изображения с одинаковыми названиями (т.е. при файлах img/main.png и img/icons/main.png сборка сломается!)
