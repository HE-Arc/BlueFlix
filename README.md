# BlueFlix
A website using TMDB's API to retrieve movies. This document provides a guide on how to set up and initialize the project on your local machine. Ensure you follow the steps outlined below to have a working development environment.

Prerequisites
-------------

Before you start, make sure you have the following software installed on your machine:
-    [Composer](https://getcomposer.org/): Dependency manager for PHP.
-    [PHP](https://www.php.net/): PHP programming language (>= 7.4).
-    [SQL](https://www.mysql.com/) or [PostgreSQL](https://www.postgresql.org/): Database server.
-    [TMDB](https://developer.themoviedb.org/docs/getting-started): Get a API Read Access Token on TMDB

Setup Instructions
------------------

Follow these steps to set up the Laravel project:

### 1\. Clone the Repository

```bash
git clone git@github.com:HE-Arc/BlueFlix.git
```

### 2\. Navigate to the Project Directory

```bash
cd BlueFlix
```

### 3\. Install Composer Dependencies


```bash
composer install
```

### 4\. Create a Copy of the `.env` File

```bash
cp .env.example .env
```

### 5\. Generate an Application Key

```bash
php artisan key:generate
```

### 6\. Configure the Database

Update the `.env` file with your database credentials:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### 7\. Configure the external API

Update the `.env` file with external API details:

```bash
API_KEY="Bearer your_token"
API_URL="https://api.themoviedb.org/3"
API_IMAGE_URL="https://image.tmdb.org/t/p/original"
API_LANGUAGE="en-US"
```

### 8\. Run Database Migrations

```bash
php artisan migrate
```

### 9\. Serve the Application

```bash
php artisan serve
```

Visit [http://127.0.0.1:8000](http://127.0.0.1:8000/) in your browser to view the application.
