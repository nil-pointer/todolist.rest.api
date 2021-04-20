<h1>Setup:</h1>

git clone https://github.com/nil-pointer/todolist.rest.api.git
cd .\todolist.rest.api\
docker-compose build
docker-compose up -d
docker exec -it todolistrestapi_symfony_1 /var/www/bin/console doctrine:database:create && /var/www/bin/console doctrine:schema:update --force

How To Use:

Rest API WEB Client:
http://localhost/api/doc

PUSH, PUT, DELETE AND GER Requests are available from here

Adminer:
http://localhost:8080/
DB: maria_db
PW: Criddel
USer:root
