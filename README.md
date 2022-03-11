# api.simple-notes.local

[Base url](https://frozen-cliffs-54998.herokuapp.com/)

### Features

- [extensible search](https://github.com/sanchos86/api.simple-notes.local/tree/master/app/NoteSearch)

### To run app locally

- install docker and docker-compose
- clone repository
- run `cd ${created folder}`
- run `cp .env.example .env`
- add following rule to /etc/hosts: `127.0.0.1 api.simple-notes.local`
- run `docker-compose up`
- run `docker exec -it app bash`
- from app container run `composer install`
- from app container run `php artisan key:generate`
- from app container run `php artisan migrate`
- app is now available on http://api.simple-notes.local:82
