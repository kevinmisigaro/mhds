# MHDS prototype system

Medicine Digital Delivery Solution system built with Laravel v.8

## Getting started

* Clone the app
* Open terminal
* Run ```cp .env.example .env``` to create .env file
* Connect to database in .env file
* Run ```composer install``` to install dependencies
* Run ```php artisan key:generate``` to generate key
* Run ```php artisan migrate --seed``` to install migrations and seeder data
* Run ```php artisan storage:link``` to create symbolic link for images
* Run ```php artisan serve``` to serve the app and enjoy!

## Authentication

* Sample Customer email: donda@gmail.com ; pass: 123456
* Sample Admin email: admin@admin.com ;  pass: 123456
* Sample Insurer email: edwards@gmail.com ; pass: 123456

## System modules

* Customer Management
* Online Doctor Consultation (to be implemented)
* Insurance Company Validation
* Service Provider Process
* Logistic – Delivery Service (to be implemented)
* General Reports