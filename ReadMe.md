<h1>Setup:</h1>

<code>
git clone https://github.com/nil-pointer/todolist.rest.api.git
cd .\todolist.rest.api\
docker-compose build
docker-compose up -d
docker exec -it todolistrestapi_symfony_1 /var/www/bin/console doctrine:database:create && /var/www/bin/console doctrine:schema:update --force
</code>

<h1>How To Use:</h1>

<h2>Rest API WEB Client:</h2>
[link](http://localhost/api/doc)

PUSH, PUT, DELETE AND GER Requests are available from here

<h2>Adminer:</h2>
[link](http://localhost:8080/)
DB: maria_db
PW: Criddel
USer:root
