# F02 & F03 - Monolith (FE & BE)

https://github.com/bangkitdc/monolith/assets/87227379/9cdd4b48-ba34-48c3-81fd-d88fc7afe1b2

## Documentation
You can read all technical and API documentation from here [Documentation](EXPLANATION.md)

## Brief Description
This app includes the frontend and backend for the User/Customer Page.

## Specification
### F02
1. Register Page
2. Login Page
3. Catalog Page and Detail Barang Page
4. Buy Barang Page (Cart Page)
5. Order History Page

### F03
1. Register
2. Login
3. Buy Barang (Cart)
4. Order History

## Tech Stack
- Laravel
- PHP
- Vite for preprocessing TailwindCSS

## How to Run
Before you run this project locally, you can copy .env.example into .env and then set the environment. After that, run it with docker.
```sh
    docker-compose build
    docker-compose up -d
```
It will automatically migrate and seed the database.

After that, if you want to connect this container to the single service container, you have to make a network between the 2 containers on the docker by applying this command on your terminal.

```sh
    docker network create my_network
    docker network connect my_network app_monolith
    docker network connect my_network go-app
```

I use go-app for the single service container and app_monolith for the monolith app in the Dockerfile.

```
    API_BASE_URL=http://localhost:8000 => API_BASE_URL=http://go-app:8000
```

## Preferable
Using laravel in the docker container is not the best option for running this app, because it's slow to build and then the average response would take about 3-5 seconds. Using the old way to run this app would be preferable.

```sh
    composer install
    setup the env
    php artisan migrate
    php artisan db:seed
    npm install
```

Open 2 terminal: for laravel application and for vite preprocessor (for the TailwindCSS)

``` sh
    npm run dev
```

``` sh
    php artisan serve --port=8080
```

Initial account
``` sh
    username: admin
    password: admin
```

## Copyright
2023 © bangkitdc. All Rights Reserved.

Nama : Muhammad Bangkit Dwi Cahyono </br> NIM : 13521055
