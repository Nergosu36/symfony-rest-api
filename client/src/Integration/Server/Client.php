<?php

namespace App\Integration\Server;

use App\Utils\Curl;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class Client
{
    private static $instance;

    public const API_VERSION = 'v1';

    public function __construct() {

    }
    private function __clone() {}

    /**
     * @return static
     */
    public static function getInstance() : self
    {
        if(empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $url
     * @param string $method
     * @param string $body
     * @return array
     */
    public static function makeCall(String $url, String $method, String $body = null) : Array
    {
        $client = new Curl();

        switch($method)
        {
            case "GET":
            {
                $response = $client->get(self::getCallUrl($url));
                $responseContent = json_decode($response->getContent(), true);
                break;
            }
            case "POST":
            {
                $response = $client->post($body, self::getCallUrl($url));
                $responseContent = json_decode($response->getContent(), true);
                break;
            }
            case "PUT":
            {
                $response = $client->put($body, self::getCallUrl($url));
                $responseContent = json_decode($response->getContent(), true);
                break;
            }
            case "PATCH":
            {
                $response = $client->patch($body, self::getCallUrl($url));
                $responseContent = json_decode($response->getContent(), true);
                break;
            }
            case "DELETE":
            {
                $response = $client->delete($body, self::getCallUrl($url));
                $responseContent = json_decode($response->getContent(), true);
                break;
            }
            default:
            {
                $response = $client->get(self::getCallUrl($url));
                $responseContent = json_decode($response->getContent(), true);
                break;
            }
        }

        return [
            'status' => $response->getStatusCode(),
            'content' => $responseContent
        ];
    }

    /**
     * @param $url
     * @return string
     */
    private static function getCallUrl($url) : String
    {
        return 'https://dev.ap1-api.pl/api/' . self::API_VERSION . '/' . trim($url, '/');
    }
}