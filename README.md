# About PHP Exercise - v21.0.5

This exercise is written using PHP Laravel 10^th^ version.   


## Setup

To set up the project, follow these steps:

1. Clone the `git@github.com:har8/xm-form.git` repository to your local machine.
2. Install the composer and run `composer install`.
3. Copy the `.env.example` file to `.env` and update the configurations.
4. Generate an application key by running `php artisan key:generate`.
5. You can use Docker as well by running `docker-compose up -d`

## Usage

To use the application, follow these steps:

1. For your continence the latest version is available under 'https://xm.walnuts.am/ website (don't ask me why walnuts :) ).
2. Access the `Mailpit` to get emails sent by application at `http://xm.walnuts.am:8025`.
3. Fill in the form fields (Company Symbol, Start Date, End Date, Email) and submit the form.
4. The application will validate the form input by UI part first, then by the beck-end part.
5. If the form validation is good to go, the App will retrieve historical data from the API provided and send an email.

## Testing

The application involves the following tests:

1. Form view minimal test
2. form validation and submission.
