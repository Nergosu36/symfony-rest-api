<?php
namespace App\Utils;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class Curl
 *
 * @package PHPHtmlParser
 */
class Curl
{
    /**
     * A simple curl implementation to get the content of the url.
     *
     * @param string $url
     * @throws \Exception
     */
    public function get(string $url): JsonResponse
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 50);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36');
        curl_setopt($ch, CURLOPT_URL, $url);

        $content = curl_exec($ch);
        if ($content === false) {
            // there was a problem
            $error = curl_error($ch);
            curl_close($ch);
            throw new \Exception('Error retrieving "'.$url.'" ('.$error.')');
        }
        curl_close($ch);
        return new JsonResponse(json_decode($content), 200);
    }

    /**
     * A simple curl implementation to get the content of the url.
     *
     * @param string $url
     * @throws \Exception
     */
    public function post($data, $url, $contentType='json', $authorization=''): JsonResponse
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 50);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        if(!isset($authorization)){
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/'.$contentType)
            );
        }
        else{
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/'.$contentType,
                    $authorization)
            );
        }

        $content = curl_exec($ch);
        if ($content === false) {
            // there was a problem
            $error = curl_error($ch);
            throw new \Exception('Error retrieving "'.$url.'" ('.$error.')');
        }
        curl_close($ch);

        return new JsonResponse(json_decode($content), 200);
    }

    /**
     * A simple curl implementation to get the content of the url.
     *
     * @param string $url
     * @throws \Exception
     */
    public function put($data, $url, $contentType='json', $authorization=''): JsonResponse
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 50);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        if(!isset($authorization)){
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/'.$contentType)
            );
        }
        else{
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/'.$contentType,
                    $authorization)
            );
        }

        $content = curl_exec($ch);
        if ($content === false) {
            // there was a problem
            $error = curl_error($ch);
            throw new \Exception('Error retrieving "'.$url.'" ('.$error.')');
        }
        curl_close($ch);

        return new JsonResponse(json_decode($content), 200);
    }

    /**
     * A simple curl implementation to get the content of the url.
     *
     * @param string $url
     * @throws \Exception
     */
    public function patch($data, $url, $contentType='json', $authorization=''): JsonResponse
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 50);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        if(!isset($authorization)){
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/'.$contentType)
            );
        }
        else{
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/'.$contentType,
                    $authorization)
            );
        }

        $content = curl_exec($ch);
        if ($content === false) {
            // there was a problem
            $error = curl_error($ch);
            throw new \Exception('Error retrieving "'.$url.'" ('.$error.')');
        }
        curl_close($ch);

        return new JsonResponse(json_decode($content), 200);
    }

    /**
     * A simple curl implementation to get the content of the url.
     *
     * @param string $url
     * @throws \Exception
     */
    public function delete($data, $url, $contentType='json', $authorization=''): JsonResponse
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 50);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        if(!isset($authorization)){
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/'.$contentType)
            );
        }
        else{
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/'.$contentType,
                    $authorization)
            );
        }

        $content = curl_exec($ch);
        if ($content === false) {
            // there was a problem
            $error = curl_error($ch);
            throw new \Exception('Error retrieving "'.$url.'" ('.$error.')');
        }
        curl_close($ch);

        return new JsonResponse(json_decode($content), 200);
    }
}
