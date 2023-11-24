<h1 align="center">
  
Веб-сервер: NGINX 1.25 - Alpine
  
PHP version: 8.2

База данных: PostgreSQL 16.1

Тематика сайта: менеджер проектов

Аналоги: Jira, YouGile, Trello
</h1>


<h3>Переменные окружения</h3>

Для проекта пока что установлена одна переменная окружения: <b>dev</b>. Соответственно, все Dockerfile(s) заточены пока что под разработку и находятся в директории (app/docker/dev).

Для продакшена предусмотрена отдельная переменная: <b>prod</b>. Все Dockerfile(s) для продакшена находятся в директории (app/docker/prod), но они пока что в процессе разработки (там что-то написано, но оно пока что не работает).


<h3>Немного другой информации</h3>

Пока сайт запускается в формате разработки (dev), возможны очень долгие прогрузки (в моём случае - от 2000 до 7000 мс, но тут зависит от системы). Как только доработаю prod, у сайта будет задержка ниже.

<h3>Разворачивание приложения в Docker</h3>

Чтобы развернуть приложение и запустить сервер:
1. Запустить Docker Engine.
2. Необходимо открыть проект (parent directory) и в среде разработки PHPStorm в терминале Ubuntu написать make init (чтобы сработала команда необходим файл Makefile). Если команда make не работает, в терминале вбиваем apt install make.
3. Для перезапуска проекта необходимо в терминале: make restart.
