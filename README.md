# TesteLaravel

## Documentation

This is a library management system built with Laravel. It provides a comprehensive set of features to manage the daily operations of a library.

## Features

- **User Management:** Manage users who have access to the system. This includes both library staff and members.
- **Book Management:** Keep track of all the books in the library. This includes details like the author, title, and availability status.
- **Loan Management:** Manage the borrowing and returning of books. The system keeps track of who has borrowed which book and when it is due to be returned.
- **Author Management:** Manage the authors of the books in the library. This includes details like the author's name and the books they have written.
- **Student Management:** Manage the students who are members of the library. This includes details like the student's name and the books they have borrowed.

## Models

Models are located in the `app/Models` directory. They represent the data structure of the application and are used to interact with the database. Here are the models in the project:

- `Author`: Represents an author
- `Book`: Represents a book in your application.
- `Loan`: Represents a loan in your application.
- `Student`: Represents a student in your application.
- `User`: Represents a user in your application.

## Migrations

Migrations are located in the `database/migrations` directory. They are like version control for the database, allowing your team to modify the database schema and stay up to date on the current schema state. Here are the migrations in your project:

- `create_users_table`: Creates the users table.
- `create_cache_table`: Creates the cache table.
- `create_jobs_table`: Creates the jobs table.
- `create_authors_table`: Creates the authors table.
- `create_books_table`: Creates the books table.

To run migrations, you can use the artisan command:

```bash```
php artisan migrate


## API's

Here are the API routes defined in your `routes/api.php` file:

- `POST /register`: Registers a new user. Handled by the `register` method in the `AuthController` class.
- `POST /login`: Logs in a user. Handled by the `login` method in the `AuthController` class.

The following routes are grouped under the `auth:api` middleware, which means they require the user to be authenticated:

- `GET /authors, POST /authors, GET /authors/{author}, PUT /authors/{author}, DELETE /authors/{author}`: These routes are for managing authors. They are handled by the `AuthorController` class.
- `GET /books, POST /books, GET /books/{book}, PUT /books/{book}, DELETE /books/{book}`: These routes are for managing books. They are handled by the `BookController` class.
- `GET /loans, POST /loans, GET /loans/{loan}`: These routes are for managing loans. The update and destroy actions are not available. They are handled by the `LoanController` class.
- `GET /students, POST /students, GET /students/{student}, PUT /students/{student}, DELETE /students/{student}`: These routes are for managing students. They are handled by the `StudentController` class.

## Email Notifications with Laravel Queue

In this application, we use Laravel's built-in queue system to handle email notifications. This allows us to perform a time-consuming task, like sending an email, in the background to improve the application's performance.

One of the instances where we use this feature is when a new user registers. We send a welcome email to the new user and a notification email to the admin to inform them about the new registration.

Here's a brief overview of how it works:

1. When a new user registers, we dispatch a job to the Laravel queue.
2. This job is responsible for sending an email notification. We use Laravel's Mailable class to construct the email.
3. The queue worker picks up the job from the queue and processes it in the background. This involves sending the email using the configured mail driver.
4. If the email is sent successfully, the job is removed from the queue. If not, the job is retried based on the configured number of attempts.

This project is hosted on a server that uses Cron for scheduling tasks. We use Cron to ensure that the Laravel queue worker is always running, even after a failure or server reboot. This is crucial for the email notifications to be sent out in a timely manner.

Remember to start the queue worker so that it can start processing jobs. You can start the queue worker using the `queue:work` artisan command:

```bash```
php artisan queue:work

## Factories

Factories are located in the `database/factories` directory. They are used to generate large amounts of database records. Here is the factory in your project:

- `StudentFactory`: Generates student records.

To run:

```bash```
php artisan tinker

## Tests

Tests are located in the `tests` directory. They are used to ensure your code behaves as expected. Here is the test file in your project:

- **TestCase:** The base test case class.

To run tests, you can use the phpunit command:

```bash```
./vendor/bin/phpunit


## Server Configuration

This application is configured to use MySQL as its database, SMTP for mail, Eloquent as its ORM, JWT for authentication, and Laravel Queue for job processing. The configuration for these services can be found in the `config` directory:

- `database.php`: Database configuration.
- `mail.php`: Mail configuration.
- `jwt.php`: JWT configuration.
- `queue.php`: Queue configuration.


