<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Working instance of the project

[Example project](https://laravel.daikuroneko.com)
## Project Set Up

This application is built in Laravel. To run the project, you need the following requirements in your server or local environment:

- Nginx, Apache or any application server that can execute php.
- PHP 8.2.1
- PHP extensions: mb-string, curl, dom
- Node 16.14.0

You can clone the repository using this command: git clone git@github.com:hakenprog/web-scraper.git
Inside the project folder, run `composer install`
Then, create a .env. You can copy the .env.example file that comes in the repository.
Execute the following command: `php artisan key:generate`
In the .env file we only care about the following fields:

- APP_NAME=Laravel
- APP_ENV=local => You can change the env according to your needs
- APP_KEY= This key should have been generated with the previous command.
- APP_DEBUG=true => In production environments this option should be changed to false
- APP_URL=http://localhost => You can change this url according to your needs
- LOG_CHANNEL=stack
- LOG_DEPRECATIONS_CHANNEL=null
- LOG_LEVEL=debug
- BROADCAST_DRIVER=log
- CACHE_DRIVER=file
- FILESYSTEM_DISK=local
- QUEUE_CONNECTION=sync
- SESSION_DRIVER=file
- SESSION_LIFETIME=120
- MIX_WEB_SCRAPER_API_URL=http://127.0.0.1:8000/api/v1/newsycombinator => This URL will be used by the frontend to retrieve the data

Once we have the .env file with the correct configuration, we can run `npm install`.
Then execute `npm run prod`.

If everything is well configured, the project should run without any problem. If you have any error, be sure that you have APP_DEBUG activated, so Laravel can show some helpful information in the browser.

If you are in a local environment, you can execute a local server with `php artisan serve`.

In my experience, most of the problems are related with folders and files permissions.

Link to a working instance of the project: [Example project](https://laravel.daikuroneko.com)

This project is running in a Debian Linux server with php 8.1.7 and node 14.9.3
## Project structure

The important files of the project are located inside de app folder, the resources folder, and the tests folder.

Inside the app folder we have the Interfaces folder. Here I created three different interfaces, WebScraper, WebScraperErrorHandler, WebScraperFormatter. These interfaces are implemented in the files inside WebScrapers folder and the Services folder.

Laravel manages a powerful tool called service container. Using the service container, we can tell Laravel what implementation of the interfaces to use. For this purpose, Laravel follows the following structure. First, we have the service provider, that is located inside the app folder, in the Providers Folder. In my case, I created a WebScraperServiceProvider, that binds the interfaces to the implementations using the register method of the class. In the case that we want to use a different implementation depending on the context, Laravel has a "contextual binding". For instance, if we want to create another WebScraper, or just an implementation of any of the interfaces, we can choose where to use this new implementation using  the WebScraperServiceProvider.
The implementations of the interfaces are injected in other classes using the constructor. For example, in app > WebScrapers  > NewsYCombinatorScraper, the WebScraperFormatter and the WebScraperErrorHandler are being injected using the Service Container.

Finally, inside the app > HTTP > Controllers folder, I created a WebScraperController. In this controller, I'm injecting a WebScraper implementation into the constructor. This class could be used as a base for new web scraper implementations. For example, the NewsYCombinatorScraperController is extending the WebScraperController. In the case that more WebScraperControllers are needed, we can tell Laravel what WebScraper implementation to use on each case using the WebScraperServiceprovider.

To communicate with the frontend, I used Inertia, that has a lot of useful methods for handling the integration with some frontend frameworks.

The frontend was developed using react. And for testing I used Jest and React Testing Library.
For the backend, I used PHPUnit, that comes with Laravel.
## Unit testing

To execute the testing in Laravel, just run the `php artisan test` command. Laravel will show a report in the terminal with all the relevant information. These tests are located in the tests folder, inside the root folder.

To execute the testing in the front end, run `npm test`. A report with the coverage and some useful information will be shown in the terminal. These tests are located in the resources > js > test folder.
