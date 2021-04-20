FROM whatwedo/symfony5:v2.1

WORKDIR /var/www/

COPY ./wishlist_rest_microservice .

RUN composer self-update --2

RUN composer install

#RUN /var/www/bin/console doctrine:database:create && /var/www/bin/console doctrine:schema:update --force

RUN chmod 775 *