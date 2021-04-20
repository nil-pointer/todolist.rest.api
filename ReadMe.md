<h1>Wishlist Rest Api</h1>
Simple Wishlist Rest-Api based on symfony and minimal bundles.

Based on OpenApi / Swagger Standard.

<h2>Setup:</h2>

Clone Project
```
git clone https://github.com/nil-pointer/todolist.rest.api.git
```
Startup Docker Compose
```
cd .\todolist.rest.api\
docker-compose build
docker-compose up -d
```
Migrate the Database
```
docker exec -it todolistrestapi_symfony_1 /var/www/bin/console doctrine:database:create && /var/www/bin/console doctrine:schema:update --force
```

<h2>How To Use:</h2>

<h3>Rest API WEB Client:</h3>
[http://localhost/api/doc](http://localhost/api/doc)

PUSH, PUT, DELETE AND GER Requests are available from here

<h3>Adminer:</h3>
[http://localhost:8080/](http://localhost:8080/)
DB: maria_db
PW: Criddel
USer:root
