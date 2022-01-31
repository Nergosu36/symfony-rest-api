# PHP symfony-rest-api
## Example of application using REST api to communicate between applications.

This project contains 2 separate applications. One is called **server**. The second is called **client**.



##### Only _server_ has access to database.

##### **Client** can communicate with **Server** using REST api, making requests and getting responses from **Server**.

##### Client application has an API controller for making requests to the server.

## Proper request can perform actions such like
* Basic CRUD for entity **Item**
* Get Items with amount greater than 0
* Get Items with amount less or equal than 0
* Get Items with amount greater than given amount (default 5)

## Item model

* _string_ Name
* _int_ Amount

## Architecture looks like this
![architecture.png](https://github.com/Nergosu36/symfony-rest-api/blob/master/architecture.png?raw=true)

### Both applications were created with PHP 7.4 and Symfony 5.4.2.

## Server application specification
* Host: dev.ap1-api.pl
* Database: localhost:homestead@secret

## Client application specification
* Host: dev.ap2-api.pl

### Applications were tested on the homestead vagrant environment.
