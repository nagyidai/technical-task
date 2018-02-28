# Birthday exchange rate

This project is a Docker container of a Laravel application that checks the exchange rate on a given day and stores the number of requests.


### Prerequisites

Docker is required to run this project - https://www.docker.com/get-docker

### Installing

Download the repository to your local folder.


Run Composer (on Windows):

<code>docker run --rm -v ${PWD}:/app composer install</code>


To start docker:

<code>docker-compose up</code>

To create the database:
<code>docker-compose exec app php artisan migrate</code>


Go to <a href="http://localhost:8080/">http://localhost:8080/</a> in your browser.



