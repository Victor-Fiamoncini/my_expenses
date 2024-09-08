# My Expenses 💸

Fullstack expenses tracker app

## Tools 🛠

-   Python v3.11.6
-   Django v5.1
-   NodeJS v18.17.0

## How to install and run (development build without Docker) 🛠

```bash
npm i # installs frontend dependencies

virtualenv venv # creates a new python virtual environment called "venv"
source venv/bin/activate # activates "venv" environment
pip install -r requirements.txt # installs backend dependencies

cp .env.example .env # creates an environment file

cd my_expenses
python manage.py crontab add # adds all cronjobs configured in settings.py
python manage.py runserver # runs development server
```

---

Released in 2021. This project is under the MIT license.

By [Victor B. Fiamoncini](https://github.com/Victor-Fiamoncini) ☕️
