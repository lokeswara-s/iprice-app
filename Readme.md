## IPrice Test

**Prerequistits**
At the time of running this project
PHP version 7.3
Composer 2.1

**Setup**

We have two directories `iprice-string-utilities` , `iprice-test`
iprice-string-utilites is a dependency for iprice-test we need to setup both in order to run cli.

1.  Navigate to `iprice-string-utilitites` and run the following command in terminal/command prompt `composer install`
2.  Navigate to iprice-test and do the same `composer install`
3.  Now we are ready to run the application

**Steps to run**

    php <filename> [-l | -u | -a] | [-c] -v "input"

Available options

1.  `-l convert to lowercase`
2.  `-u convert to uppercase`
3.  `-a convert to alternate case`
4.  `-c` is an optional if we want to generate csv in root folder we will add this optional flag

**Unit Testing**

Navigate to `iprice-string-utilitites` and run the following command.

    ./vendor/bin/phpunit --testdox tests
