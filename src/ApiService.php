<?php


namespace Cblink\Service\OAuth;


use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ApiService
{
    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var string
     */
    protected $token;

    public function __construct($baseUrl, $token)
    {
        $this->baseUrl = $baseUrl;
        $this->token = $token;
    }

    /**
     * @param $authorization
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getUser($authorization)
    {
        return $this->request('token', [
            'query' => [
                'token' => strtoupper(md5($this->token)),
            ],
            'headers' => [
                'Authorization' => $authorization
            ]
        ]);
    }

    /**
     * @return array
     */
    public function hasPermission()
    {
        return [];
    }

    /**
     * @return bool
     */
    public function getPermission()
    {
        return true;
    }

    /**
     * @param $uri
     * @param array $options
     * @param string $method
     * @return false|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function request($uri, array $options = [], $method = Request::METHOD_POST)
    {
        $options = array_merge([
            'verify' => false,
            'http_errors' => false,
        ],$options);

        $response = $this->getClient()
            ->request(
                $method,
                $this->url($uri),
                $options
            );

        if ($response->getStatusCode() !== 200) {

            $body = json_decode($response->getBody()->getContents(), true);

            if (!json_last_error() && isset($body['err_code'], $body['data']) && $body['err_code'] == 0) {
                return $body['data'];
            }

        }

        return false;
    }

    /**
     * @param $uri
     * @return string
     */
    protected function url($uri)
    {
        return rtrim($this->baseUrl, '/') . ltrim($uri, '/');
    }


    /**
     * @return Client
     */
    protected function getClient()
    {
        return app(Client::class);
    }
}