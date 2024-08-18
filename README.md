# My Expenses 💸

Fullstack expenses tracker app

## Tools 🛠

Nodejs v12.22.12
Ruby v3.0.3
Bundler v2.2.32

## How to install and run (development build) 🛠

```bash
cp .env.example .env # creates an environment file
docker-compose up --build # builds and starts rails and postgres containers
docker exec -it web bash # access rails container
whenever --update-crontab --set environment='development' # starts cron jobs
```

----------
Released in 2021. This project is under the MIT license.

By [Victor B. Fiamoncini](https://github.com/Victor-Fiamoncini) ☕️
