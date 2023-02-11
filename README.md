# Laravel TODO

## Installation Steps

**1. Clone the project**

```sh
git clone https://github.com/ubpon/sample-todo.git
```

and switch to cloned project

```sh
cd sample-todo
```

**2. Copy `.env.example` to `.env`**

```sh
cp .env.example .env
```

**3. Create database and update the `.env` file accordingly**

**4. Install dependencies and run commands**

```sh
composer install
php artisan key:generate
php artisan migrate
npm install && npm run dev
php artisan serve
```