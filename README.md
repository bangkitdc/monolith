# F02 & F03 - Monolith (FE & BE)

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

I use go-app for the single service container and app_monolith for the monolith app.

## Copyright
2023 © bangkitdc. All Rights Reserved.
