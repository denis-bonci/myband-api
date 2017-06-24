MyBand Api
==========
This project is the API side of MyBand application.

# Setup

This project is based on Symfony 3 framework and PostgreSQL database.

1. Install [Composer](https://getcomposer.org/);
2. Install required packages running `composer install`;
3. Run doctrine create schema running `php bin/console doctrine:schema:create`;
4. Run doctrine fixture fixture loading `php bin/console doctrine:fixtures:load`;
