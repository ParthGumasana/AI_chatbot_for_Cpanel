# backend/passenger_wsgi.py

import os
import sys

# Ensure the directory containing your Flask app is in the Python path
sys.path.insert(0, os.path.dirname(__file__))

# If you use a virtual environment, activate it here for cPanel
# Example: sys.path.insert(0, os.path.join(os.path.dirname(__file__), 'venv/lib/pythonX.Y/site-packages'))
# where X.Y is your Python version (e.g., 3.9)

# Import your Flask app instance. It MUST be named 'application' for Passenger.
from backend.app import app as application

# Set environment variables for MySQL and Flask API Key if not set globally on cPanel
# For local testing, these are typically handled in `if __name__ == '__main__':` block in app.py
# For cPanel, you would set them in the "Setup Python App" interface.
# os.environ['MYSQL_HOST'] = 'localhost'
# os.environ['MYSQL_DATABASE'] = 'chatbot_saas'
# os.environ['MYSQL_USER'] = 'your_mysql_user'
# os.environ['MYSQL_PASSWORD'] = 'your_mysql_password'
# os.environ['FLASK_API_KEY'] = 'your_super_secret_flask_api_key'
# os.environ['LM_STUDIO_BASE_URL'] = 'http://192.168.234.1:1234/v1'
# os.environ['LM_STUDIO_MODEL_NAME'] = 'gemm3:4b'
