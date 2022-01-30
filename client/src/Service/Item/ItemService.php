<?php

namespace App\Service\Item;

use App\Integration\Server\Client;

class ItemService
{
    private $client;

    public function __construct()
    {
        $this->client = Client::getInstance();
    }

    public function getAvailableItems(): Array
    {
        return $this->client->makeCall('/item/getAvailableItems', 'GET');
    }

    public function getUnavailableItems(): Array
    {
        return $this->client->makeCall('/item/getUnavailableItems', 'GET');
    }

    public function getItemsWithGTAmount(Int $amount = 5): Array
    {
        return $this->client->makeCall('/item/getItemsWithGTAmount?amount='.$amount, 'GET');
    }

    public function getItems(): Array
    {
        return $this->client->makeCall('/item/Items', 'GET');
    }

    public function getItem(Int $id): Array
    {
        return $this->client->makeCall('/item/Items/'.$id, 'GET');
    }

    public function postItem(String $item): Array
    {
        return $this->client->makeCall('/item/Items', 'POST', $item);
    }

    public function putItem(String $item, Int $id): Array
    {
        return $this->client->makeCall('/item/Items/'.$id, 'PUT', $item);
    }

    public function patchItem(String $item, Int $id): Array
    {
        return $this->client->makeCall('/item/Items/'.$id, 'PATCH', $item);
    }

    public function deleteItem(Int $id): Array
    {
        return $this->client->makeCall('/item/Items/'.$id, 'DELETE');
    }
}