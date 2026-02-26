📦 PHP CRUD App with Docker & PostgreSQL

This project is a full CRUD (Create, Read, Update, Delete) API built in PHP, using PostgreSQL as the database, and Docker for containerized development. It also includes Adminer for easy database management.

🛠️ Features

RESTful PHP API (GET, POST, PUT, DELETE)

PostgreSQL database

Adminer web interface for database management

Dockerized environment for easy setup

📁 Project Structure
my-crud-app/
│
├─ apa.php                # Main PHP CRUD API
├─ index.php           # PostgreSQL connection and php code
├─ Dockerfile             # PHP container
├─ docker-compose.yml     # Docker services (PHP + PostgreSQL + Adminer)
├─ README.md
└─ logs/                  # Optional logs (ignored)
⚡ Requirements

Docker & Docker Compose

PHP  8.2

Composer (for local dependency management)

🚀 Setup Instructions

Clone the repository:

git clone https://github.com/<username>/<repo-name>.git
cd my-crud-app

Create .env file (copy from .env.example if provided) and set your database credentials:

POSTGRES_USER=postgres
POSTGRES_PASSWORD=postgres
POSTGRES_DB=userdb

Start Docker containers:

docker-compose up -d

PHP container

PostgreSQL container

Adminer container (http://localhost:8080)

Install Composer dependencies (optional if running inside Docker):

composer install
🌐 API Endpoints
Method	Endpoint	Description	Request Body / Params
GET	/api.php?id=...	Get user by ID	Query param id
GET	/api.php	Get all users	None
POST	/api.php	Create new user	JSON: name, email, phone_number
PUT	/api.php	Update user	JSON: id, name, email, phone_number
DELETE	/api.php	Delete user	JSON: id

Example POST request body:

{
  "name": "mansoor",
  "email": "mansoor@example.com",
  "phone_number": "0123456789"
}****
