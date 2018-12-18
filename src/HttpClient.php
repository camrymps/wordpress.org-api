<?php

namespace WordPressOrgApi;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Promise;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

/**
*  Class for making http requests and decoding those request's responses.
*
*  @author Michael Scott
*
*/

class HttpClient {

    private $guzzle;
    private $return_assoc;

    public function __construct($return_assoc) 
    {
        $this->guzzle = new GuzzleClient();
        $this->return_assoc = $return_assoc;
    }

    /**
     * Decodes JSON string to either an object or an associative array.
     * 
     * @param string $str The JSON string
     * 
     * @return object|array
     * 
     */
    private function decode($str) {
        if ($this->return_assoc) {
            return json_decode($str, true);
        }

        return json_decode($str);
    }

    /**
     * Returns the decoded body of a response.
     * 
     * @param object $res The request's response object
     * 
     * @return object|array
     * 
     */
    private function handleResponse($res) {
        $res = $res->getBody()->getContents();

        // Catch-all for errors
        if (!is_object(json_decode($res))) {
            $res =  json_encode(
                [ 'error' => 'Bad request.' ]
            );
        }

        return $this->decode($res);
    }

    /**
     * Returns a decoded, human-readable error if an exception,
     * while making a request, occurs.
     * 
     * @param object $e The exception object
     * 
     * @return object|array
     * 
     */
    private function handleException($e) 
    {
        $res = json_encode(
            [ 'error' => $e->getResponse()->getReasonPhrase() ]
        );

        return $this->decode($res);
    }

    /**
     * Returns "stringified" parameters for request URL. 
     * 
     * @param array $params Array of request parameters
     * 
     * @return string 
     * 
     */
    private function buildParams($params) 
    {
        if ($params['action']) {
            $action = $params['action'];

            unset($params['action']);

            return http_build_query(
                [ 'action' => $action, 'request' => $params ]
            );
        } 

        return http_build_query($params);
    }

    /**
     * Returns generated request URL.
     * 
     * @param string $endpoint Request endpoint
     * @param array $params Array of request parameters
     * 
     * @return string
     * 
     */
    private function buildRequest($endpoint, $params)
    {
        return $params ? $endpoint . '?' . $this->buildParams($params) : $endpoint;
    }

    /**
     * Makes a GET request to a URL.
     * 
     * @param string $endpoint Request endpoint
     * @param array $params Array of request parameters
     * 
     * @return object|array
     * 
     */
    public function makeRequest($endpoint, $params = []) 
    {
        try {
            $res = $this->guzzle->get($this->buildRequest($endpoint, $params));
        } catch (ClientException $e) {
            return $this->handleException($e);
        }

        return $this->handleResponse($res);
    }

    /**
     * Make an asynchronous GET request to URL.
     * 
     * @param string $endpoint Request endpoint
     * @param array $params Array of request parameters
     * 
     * @return {Promise.<object|array, object|array>}
     * 
     */
    public function makeAsyncRequest($endpoint, $params = []) 
    {
        $promise = $this->guzzle->getAsync($this->buildRequest($endpoint, $params));

        return $promise->then(
            function(ResponseInterface $res) {
                return $this->handleResponse($res);
            },
            function(RequestException $e) {
                return $this->handleException($e);
            }
        );
    }
}