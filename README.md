Install packages and build docker:

    1. composer install
    2. cat .env.example .env
    3. ./vendor/bin/sail build && ./vendor/bin/sail up -d

Сохранение пользователя с помощью App\Services\UserFile в файл storage\app\users.txt

При запуске докера выполняется команда на получение курса биткоина (App\ExternalAPI), который кладется в кэш (Redis)
Каждую минуту этот кэш обновляется с помощью шедуллера (который также запускается при старте докера супервизором ./docker/8.0/)
В условиях задания было написано, что хранить курс не надо, но сделал так.
В контроллере можно удалить текущую строчку, раскомментить вторую и все должно работать:)

При логине в редис кладется сгенеренный токен юзера, по которому он потом может получать рейт битка.
Токен проверяется в мидлвейре

Оба роута /user/create и /user/login ожидают две строки email, password
Роут /btcRate ожидает в хедере Authorization бирер токен
