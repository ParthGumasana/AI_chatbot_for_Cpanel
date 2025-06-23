# AI Chatbot SaaS Application (Flask + Laravel + MySQL)

This repository contains the full codebase for a SaaS AI Chatbot application, allowing users to create their own chatbots by providing URLs, PDFs, Excel, and Word documents as context. The backend uses Python Flask with Socket.IO, and the frontend is built with PHP Laravel. **MySQL** serves as the primary and only application database for user management, chatbot configurations, and human handoff requests.

## Features

* **User Authentication:** Standard Laravel authentication (email/password) storing users directly in MySQL.
* **Chatbot Creation:** Users can create multiple custom chatbots.
* **Flexible Data Ingestion:**
    * Web Scraping: Provide URLs for the chatbot to learn from.
    * File Uploads: Upload PDF, Excel (.xlsx), and Word (.docx) documents.
* **LLM Switching:** Use Gemma 3:4b from LM Studio for local testing and easily switch to OpenAI API for production (requires OpenAI API Key).
* **Embeddable Widget:** Users get an embeddable HTML/JavaScript snippet to place their chatbot on any website. This widget communicates directly with the Flask backend's public API endpoints.
* **Human Handoff:** Chatbots can intelligently handoff conversations to a human agent, collecting user name, email, and phone number, stored in MySQL.
* **Admin Panel:** View pending human handoff requests (authenticated via Laravel's system).
* **Real-time Updates:** Socket.IO for live data processing status updates to the user dashboard and new handoff request alerts to the admin panel.

## Technology Stack

* **Backend:** Python 3.9+ (Flask, Flask-SocketIO, Gunicorn, `mysql-connector-python`, LangChain, Playwright, pypdf, openpyxl, python-docx)
* **Frontend:** PHP Laravel 10+, Blade Templates, Vite, Tailwind CSS
* **Database:** **MySQL** (for all application data: users, chatbot configs, handoff requests), SQLite (for local backend accuracy logging only).
* **Vector Store:** ChromaDB (local persistence on server filesystem).
* **LLMs:** LM Studio (local Gemma 3:4b), OpenAI GPT-3.5 Turbo.
* **Deployment Target:** cPanel (with Python App, PHP, MySQL, Apache/Nginx, Passenger).

## Project Structure


your_saas_chatbot_local/
├── backend/
│   ├── app.py                     # Flask application (main backend logic)
│   ├── requirements.txt           # Python dependencies
│   ├── passenger_wsgi.py          # Not strictly needed for local, but good to include
│   ├── create_tables.sql          # SQL schema for MySQL database
│   ├── uploads/                   # Temporary file storage (created by app.py)
│   └── chroma_dbs/                # Vector databases for chatbots (created by app.py)
├── frontend/
│   ├── .env                       # Laravel environment variables
│   ├── composer.json              # Laravel project dependencies (boilerplate)
│   ├── public/                    # Laravel's web root, includes embed widget
│   │   └── index.php              # Laravel entry point (boilerplate)
│   │   └── chatbot_embed_widget.html # The embeddable chatbot widget
│   ├── app/
│   │   └── Http/
│   │       └── Controllers/
│   │           ├── DashboardController.php
│   │           ├── ChatbotController.php
│   │           └── AdminController.php
│   ├── resources/
│   │   ├── css/
│   │   │   └── app.css            # Tailwind CSS input (boilerplate)
│   │   ├── js/
│   │   │   └── app.js             # Main JavaScript bundle
│   │   └── views/
│   │       ├── layouts/
│   │       │   └── app.blade.php  # Base Blade layout
│   │       ├── welcome.blade.php  # Laravel default welcome
│   │       ├── dashboard.blade.php
│   │       ├── chatbots/
│   │       │   ├── create.blade.php
│   │       │   └── show.blade.php
│   │       └── admin/
│   │           └── handoffs.blade.php
│   ├── routes/
│   │   └── web.php
│   ├── vite.config.js             # Vite configuration for frontend assets (boilerplate)
│   └── (other Laravel boilerplate files like config/, database/, etc.)
└── README.md                      # Overall project setup and deployment guide


## Local Setup Instructions

### 1. Prerequisites

Before you begin, ensure you have the following installed:

* **Python 3.9+**
* **PHP 8.1+**
* **Composer** (PHP dependency manager)
* **Node.js** (LTS version recommended) & **npm**
* **MySQL Server** (e.g., via XAMPP, MAMP, Docker, or direct installation)

### 2. MySQL Database Setup

1.  **Start MySQL Server:** Ensure your MySQL server is running.
2.  **Create Database:**
    * Open your MySQL client (e.g., `mysql` command line, phpMyAdmin, MySQL Workbench).
    * Create a new database. Let's name it `chatbot_saas`.
        ```sql
        CREATE DATABASE IF NOT EXISTS chatbot_saas;
        ```
    * (Optional but recommended for production): Create a dedicated user for this database and grant privileges. For local testing, `root` with no password might suffice, but it's not secure for production.
        ```sql
        CREATE USER 'your_mysql_user'@'localhost' IDENTIFIED BY 'your_mysql_password';
        GRANT ALL PRIVILEGES ON chatbot_saas.* TO 'your_mysql_user'@'localhost';
        FLUSH PRIVILEGES;
        ```
3.  **Create Tables:**
    * Navigate to your `backend/` directory where `create_tables.sql` is located.
    * Execute the SQL script against your `chatbot_saas` database.
        ```bash
        mysql -u your_mysql_user -p chatbot_saas < create_tables.sql
        # Enter your_mysql_password when prompted
        ```
        (If using `root` with no password: `mysql -u root chatbot_saas < create_tables.sql`)

### 3. Backend Setup (Python Flask)

1.  **Create Project Directories:** Create a main project directory (e.g., `your_saas_chatbot_local`) and inside it, create a `backend/` directory.
2.  **Place Backend Files:** Copy `app.py`, `requirements.txt`, `passenger_wsgi.py`, and `create_tables.sql` into the `backend/` directory.
3.  **Create Virtual Environment:**
    ```bash
    cd backend
    python3 -m venv venv
    source venv/bin/activate # On Windows: .\venv\Scripts\activate
    ```
4.  **Install Python Dependencies:**
    ```bash
    pip install -r requirements.txt
    ```
5.  **Install Playwright Browsers:**
    ```bash
    playwright install
    ```
6.  **Configure Environment Variables (Locally):**
    * Open `backend/app.py`. Inside the `if __name__ == '__main__':` block at the bottom, ensure the `os.environ` variables are set correctly for your local MySQL setup and Flask API key.
        ```python
        os.environ['MYSQL_HOST'] = 'localhost'
        os.environ['MYSQL_DATABASE'] = 'chatbot_saas'
        os.environ['MYSQL_USER'] = 'root' # Or your MySQL user
        os.environ['MYSQL_PASSWORD'] = '' # Your MySQL password
        os.environ['FLASK_API_KEY'] = 'your_super_secret_flask_api_key' # IMPORTANT: SET A STRONG, UNIQUE KEY!
        os.environ['LM_STUDIO_BASE_URL'] = '[http://192.168.234.1:1234/v1](http://192.168.234.1:1234/v1)' # Or your LM Studio URL
        os.environ['LM_STUDIO_MODEL_NAME'] = 'gemm3:4b' # Or your LM Studio model name
        ```
    * **LM Studio Setup (Optional but Recommended for Testing LLM):** Download and run [LM Studio](https://lmstudio.ai/). Download the `gemma-3-4b` model (or similar) within LM Studio, then start its local server. Ensure the `LM_STUDIO_BASE_URL` and `LM_STUDIO_MODEL_NAME` in `app.py` match your LM Studio configuration.
7.  **Run Flask Backend:**
    ```bash
    python app.py
    ```
    The backend should start and listen on `http://0.0.0.0:5000`. Keep this terminal running.

### 4. Frontend Setup (PHP Laravel)

1.  **Create Laravel Project:**
    * Go back to your main project directory (`your_saas_chatbot_local/`).
    * Create a new Laravel project for the frontend:
        ```bash
        composer create-project laravel/laravel frontend_app
        ```
    * Move into the new frontend directory:
        ```bash
        cd frontend_app
        ```
2.  **Configure `.env`:**
    * Copy the content of `frontend/.env` provided above and overwrite your `frontend_app/.env` file.
    * **Generate `APP_KEY`**:
        ```bash
        php artisan key:generate
        ```
    * Update `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` to match your MySQL setup.
    * Update `VITE_FLASK_BACKEND_URL` to `http://localhost:5000`.
    * Set `FLASK_BACKEND_API_KEY` to the **exact same secret key** you set in your Flask `app.py`.
3.  **Install Laravel Breeze (for Authentication):**
    ```bash
    composer require laravel/breeze --dev
    php artisan breeze:install blade # Choose 'blade' for this project's views
    ```
4.  **Run Laravel Migrations:** This will create the `users` table and other default Laravel tables in your `chatbot_saas` MySQL database.
    ```bash
    php artisan migrate
    ```
5.  **Install Frontend Dependencies:**
    ```bash
    npm install
    ```
6.  **Compile Frontend Assets:**
    ```bash
    npm run dev # This will compile assets and keep watching for changes
    ```
    Keep this terminal running.
7.  **Place Frontend Files (Manual Copy):**
    * Copy the provided Laravel Controller files (`DashboardController.php`, `ChatbotController.php`, `AdminController.php`) into `frontend_app/app/Http/Controllers/`.
    * Copy the provided Blade view files (`dashboard.blade.php`, `chatbots/create.blade.php`, `chatbots/show.blade.php`, `admin/handoffs.blade.php`, `layouts/app.blade.php`, `welcome.blade.php`) into their corresponding paths under `frontend_app/resources/views/`.
    * Copy the provided `app.js` into `frontend_app/resources/js/`.
    * Copy the provided `chatbot_embed_widget.html` into `frontend_app/public/`.
    * Copy the `web.php` routes file into `frontend_app/routes/`.
    * Copy `vite.config.js` into `frontend_app/`.
8.  **Run Laravel Development Server:**
    ```bash
    php artisan serve
    ```
    The frontend should be accessible at `http://127.0.0.1:8000` (or a similar address).

### 5. Test the Application

1.  **Access Frontend:** Open `http://127.0.0.1:8000` in your web browser.
2.  **Register:** Click "Register" and create a new user. This will create an entry in your MySQL `users` table (via Laravel) and also in the Flask backend's `users` table (via the `api/register_user_backend` endpoint).
3.  **Login:** Log in with your new user.
4.  **Dashboard:** You should be redirected to the dashboard.
5.  **Create Chatbot:** Go to "Create New Chatbot", fill in details, and submit.
6.  **Upload Data:** On the chatbot management page, provide some URLs (e.g., documentation pages) or upload test PDF/DOCX/XLSX files. Watch the backend console for processing messages. The dashboard should show "Processing..." and then "Ready".
7.  **Embed Widget:** Copy the embed snippet from the chatbot management page. You can paste this directly into a simple HTML file on your local machine to test the widget (ensure the `src` attribute correctly points to your Flask backend, e.g., `http://localhost:5000/embed/<chatbot_id>?ownerId=<user_id>`).
8.  **Chat with Bot:** Interact with the embedded chatbot. Test general questions and the "human" handoff feature.
9.  **Admin Handoffs:** Access `/admin/handoffs` (e.g., `http://127.0.0.1:8000/admin/handoffs`) to see pending handoff requests. You can mark them as resolved.

By following these steps, you should have a fully functional local development environment for your SaaS chatbot.
