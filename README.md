# TODO App

## Local Setup and Testing Instructions

1. **Clone the Repository:**
   - Download or clone this TODO application from the GitHub repository.
   - Use a Git client or download the ZIP file and extract it to your chosen directory.

2. **Set Up the Database:**
   - Open the `db.php` file in the project directory using a text editor.
   - Adjust the database connection details (`$host`, `$username`, `$password`, `$database`) to match your local database configuration.

3. **Create Database Tables:**
   - Run the following SQL query in your database to create the necessary table:

   ```sql
   CREATE TABLE todo (
       id INT AUTO_INCREMENT PRIMARY KEY,
       title VARCHAR(255) NOT NULL,
       description TEXT,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   );

4. **Install Dependencies:**
   - Ensure you have PHP installed on your local machine.
   - Confirm that your web server (e.g., Apache, Nginx) is running.

5. **Run the Application:**
   - Navigate to the project directory.
   - Start a PHP server (if not using a web server) by running `php -S localhost:8000` in the terminal.
   - Access the application in your web browser at [http://localhost:8000](http://localhost:8000).

6. **Test the Application:**
   - Open the TODO application in your web browser.
   - Add, update, and delete tasks to ensure the application works as expected.

