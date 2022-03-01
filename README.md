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

## Endpoints
### Server
* **GET** /api/v1/item/getAvailableItems - returns a list of all **Items** with **amount** > 0
* **GET** /api/v1/item/getUnavailableItems - returns a list of all **Items** with **amount** <= 0
* **GET** /api/v1/item/getItemsWithGTAmount - returns a list of all **Items** with **amount** > **given_amount** (default 5)
* **GET** /api/v1/item/Items - returns a list of all **Items**
* **POST** /api/v1/item/Items - creates a new **Item**
* **GET** /api/v1/item/Items/{id} - returns an **Item** of specific **id**
* **PUT** /api/v1/item/Items/{id} - exchanges **Item** of specific **id** with a new one
* **PATCH** /api/v1/item/Items/{id} - updates an **Item** of specific **id** with a new values
* **DELETE** /api/v1/item/Items/{id} - removes an **Item** of specific **id**

### Client
* **GET** /api/v1/getAvailableItems - returns a list of all **Items** with **amount** > 0
* **GET** /api/v1/getUnavailableItems - returns a list of all **Items** with **amount** <= 0
* **GET** /api/v1/getItemsWithGTAmount - returns a list of all **Items** with **amount** > **given_amount** (default 5)
* **GET** /api/v1/getItems - returns a list of all **Items**
* **POST** /api/v1/postItem - creates a new **Item**
* **GET** /api/v1/getItem/{id} - returns an **Item** of specific **id**
* **PUT** /api/v1/putItem/{id} - exchanges **Item** of specific **id** with a new one
* **PATCH** /api/v1/patchItem/{id} - updates an **Item** of specific **id** with a new values
* **DELETE** /api/v1/deleteItem/{id} -removes an **Item** of specific **id**

## Payload for POST/PUT/PATCH
#### _Json format_
```
{
    "name": "Name of item",
    "amount": 10
}
```

## Item model

* _string_ Name
* _int_ Amount

## Architecture looks like this
![architecture.png](https://user-images.githubusercontent.com/39529730/151795902-948ef59a-b0a7-447e-b19e-b55442eedf6f.png)

### Both applications were created with PHP 7.4 and Symfony 5.4.2.

## Server application specification
* Host: dev.ap1-api.pl
* Database: localhost:homestead@secret

## Client application specification
* Host: dev.ap2-api.pl

### Applications were tested on the homestead vagrant environment.
