# *Проект прогноза погоды "Дождь будет?"*
 

 Веб-приложение, с помощью которого можно узнать прогноз погоды в любом населённом пункте на ближайшее время.
Пользователь вводит интересующий регион и выбирает подходящий из выпадающего списка.

 ![image](https://github.com/chickenshrimp/weather_forecast/assets/95221256/c9dc383b-aa6e-41c8-b5c8-ebe932da207d)

 Проект написан на **php Symfony** с использованием следующих технологий:
 - twig
 - javascript, css
 - yandex API

 
# Docker

 Приложение было запаковано в контейнеры с помощью *docker compose*.

 ![image](https://github.com/chickenshrimp/weather_forecast/assets/95221256/39fde2e2-8819-44eb-ad8f-63e329297622)
 ![image](https://github.com/chickenshrimp/weather_forecast/assets/95221256/03cec066-700e-4074-b0da-57b484b212fb)

 **Dockerfile** для сборки зависимостей приложения:
 - [Dockerfile](https://github.com/chickenshrimp/weather_forecast/blob/main/Dockerfile)

 **Nginx** файл для создания сервера:
 - [default.conf](https://github.com/chickenshrimp/weather_forecast/blob/main/nginx/default.conf)

 В последствии сборка и развёртка контейнеров были реализованы через *bash*-скрипты.
 
 - [build.sh](https://github.com/chickenshrimp/weather_forecast/blob/main/build.sh)
 - [deploy.sh](https://github.com/chickenshrimp/weather_forecast/blob/main/deploy.sh)

 Запуск через консоль со своим тэгом:
 ```bash
 ./build.sh -t mytag

 ./deploy.sh -t mytag
 ```
 
# Логирование приложения

 Логи приложения можно посмотреть с помощью **grafana** и **prometheus**.

 Код для интеграции этих сервисов в приложение можно посмотреть здесь:

 - [prometheus.yaml](https://github.com/chickenshrimp/weather_forecast/blob/main/prometheus/prometheus.yaml)
 - [docker-compose.yaml](https://github.com/chickenshrimp/weather_forecast/blob/main/docker-compose.yml)

 После перезапуска контейнеров и повторной сборки через `docker-compose up --build` интерфейс **grafana** доступен через **localhost:3000**:

 ![image](https://github.com/chickenshrimp/weather_forecast/assets/95221256/bd0de9b7-5061-43d7-8c0b-8cdf84f6c707)

 На скрине выше уже используется источник данных **prometheus**.

 **Prometheus** доступен через **localhost:9090**, предварительно настроенный в соединениях **grafana**. Интерфейс позволяет фильтровать логи по конкретным характеристикам. Например по `http_requests_total`:

 ![image](https://github.com/chickenshrimp/weather_forecast/assets/95221256/0584ec7e-008e-4469-af0f-f90683c6ad4f)

 Окончательный вид всех контейнеров приложения в **Docker hub**:

 ![image](https://github.com/chickenshrimp/weather_forecast/assets/95221256/98f1a5f2-ce0b-403f-8b70-0c36e485daf2)

 

