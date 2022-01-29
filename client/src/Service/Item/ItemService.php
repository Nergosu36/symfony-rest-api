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

    public function getAvailableItems()
    {
        return $this->client->makeCall('/item/getAvailableItems', 'GET');
    }

    public function getUnavailableItems()
    {
        return $this->client->makeCall('/item/getUnavailableItems', 'GET');
    }

    public function getItemsWithGTAmount(Int $amount = 5)
    {
        return $this->client->makeCall('/item/getItemsWithGTAmount?amount='.$amount, 'GET');
    }

    public function getItems()
    {
        return $this->client->makeCall('/item/Items', 'GET');
    }

    public function getItem(Int $id)
    {
        return $this->client->makeCall('/item/Items/'.$id, 'GET');
    }

    public function postItem(String $item)
    {
        return $this->client->makeCall('/item/Items', 'POST', $item);
    }

    public function putItem(String $item, Int $id)
    {
        return $this->client->makeCall('/item/Items/'.$id, 'PUT', $item);
    }

    public function patchItem(String $item, Int $id)
    {
        return $this->client->makeCall('/item/Items/'.$id, 'PATCH', $item);
    }

    public function deleteItem(Int $id)
    {
        return $this->client->makeCall('/item/Items/'.$id, 'DELETE');
    }
}