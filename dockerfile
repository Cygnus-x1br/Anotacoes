FROM php:7.4-cli
COPY . /usr/src/Notes
WORKDIR /usr/src/Notes
CMD [ "php", "./public/index.php" ]