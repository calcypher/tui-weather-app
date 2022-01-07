# Dockerfile for TUI Weather App

FROM php:7.4-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev wget

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#RUN apt -y install php-curl php-cli php-soap php-xml php-mbstring php-zip php-gd php-pear php-dev php-intl git zip nano wget libaio1

RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

WORKDIR /app
COPY . /app

RUN composer install

EXPOSE 8000
ENTRYPOINT ["symfony", "server:start"]