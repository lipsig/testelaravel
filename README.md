# testelaravel

Documentation

This is a library management system built with Laravel. It provides a comprehensive set of features to manage the daily operations of a library.

Features

User Management: Manage users who have access to the system. This includes both library staff and members.
Book Management: Keep track of all the books in the library. This includes details like the author, title, and availability status.
Loan Management: Manage the borrowing and returning of books. The system keeps track of who has borrowed which book and when it is due to be returned.
Author Management: Manage the authors of the books in the library. This includes details like the author's name and the books they have written.
Student Management: Manage the students who are members of the library. This includes details like the student's name and the books they have borrowed.

Models
Are located in the app/Models directory. They represent the data structure of the application and are used to interact with the database. Here are the models in the project:

Author: Represents an author
Book: Represents a book in your application.
Loan: Represents a loan in your application.
Student: Represents a student in your application.
User: Represents a user in your application.


Migrations
Migrations are located in the database/migrations directory. They are like version control for the database, allowing your team to modify the database schema and stay up to date on the current schema state. Here are the migrations in your project:


create_users_table: Creates the users table.
create_cache_table: Creates the cache table.
create_jobs_table: Creates the jobs table.
create_authors_table: Creates the authors table.
create_books_table: Creates the books table.

To run migrations, you can use the artisan command:

php artisan migrate


API'S

Here are the API routes defined in your routes/api.php file:

POST /register: Registers a new user. Handled by the register method in the AuthController class.
POST /login: Logs in a user. Handled by the login method in the AuthController class.

The following routes are grouped under the auth:api middleware, which means they require the user to be authenticated:

GET /authors, POST /authors, GET /authors/{author}, PUT /authors/{author}, DELETE /authors/{author}: These routes are for managing authors. They are handled by the AuthorController class.
GET /books, POST /books, GET /books/{book}, PUT /books/{book}, DELETE /books/{book}: These routes are for managing books. They are handled by the BookController class.
GET /loans, POST /loans, GET /loans/{loan}: These routes are for managing loans. The update and destroy actions are not available. They are handled by the LoanController class.
GET /students, POST /students, GET /students/{student}, PUT /students/{student}, DELETE /students/{student}: These routes are for managing students. They are handled by the StudentController class.


Factories

Factories are located in the database/factories directory. They are used to generate large amounts of database records. Here is the factory in your project:

StudentFactory: Generates student records.

to run: php artisan tinker


Tests
Tests are located in the tests directory. They are used to ensure your code behaves as expected. Here is the test file in your project:

TestCase: The base test case class.

To run tests, you can use the phpunit command:
./vendor/bin/phpunit




Server Configuration
This application is configured to use MySQL as its database, SMTP for mail, Eloquent as its ORM, JWT for authentication, and Laravel Queue for job processing. The configuration for these services can be found in the config directory:

database.php: Database configuration.
mail.php: Mail configuration.
jwt.php: JWT configuration.
queue.php: Queue configuration.



