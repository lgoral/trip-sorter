## Installation

Download `composer.phar` https://getcomposer.org/download/ and run


```
php composer.phar install
```

## Run the application

```
php index.php
```

## Run tests

```
php vendor/bin/phpunit -c phpunit.xml.dist
```

## How to extend the code towards new types of transportation

* Add new type of BoardingCard class in folder `src/Moldel/` that extends `AbstractBoardingCard`
* Example of usage BoardingCards is in `index.php`
