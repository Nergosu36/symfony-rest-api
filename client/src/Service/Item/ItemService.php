<?php

namespace App\Service\Item;

use App\Integration\Server\Client;

class ItemService
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAvailableItems()
    {
        $this->client->makeCall();
    }
}