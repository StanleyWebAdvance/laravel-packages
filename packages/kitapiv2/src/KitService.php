<?php

namespace Webadvance\Kitapiv2;

use GuzzleHttp\Client;
use Webadvance\Kitapiv2\helpers\StringHelp;

class KitService
{
    private $client;
    private $base_uri = 'https://capi.tk-kit.com/2.0/';

    public function __construct()
    {
        if (empty(getenv('TOKEN_KIT'))) {

            throw new \Exception('Добавьте токен в файл .env TOKEN_KIT=token');
        }

        $this->client  = new Client(
            [
            'base_uri' => $this->base_uri,
            'headers'  => [
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer ' . getenv('TOKEN_KIT'),
            ],
        ]);
    }

    public function post(FunctionInterface $function)
    {
        $content = $this->client->request('POST', $function->uri(),
            [
                'form_params' => $function->params(),
            ]
        )->getBody()->getContents();

        $content = StringHelp::checkC($content);

        return json_decode($content);
    }

    public function json(FunctionInterface $function)
    {
        $content = $this->client->request('PUT', $function->uri(),
            [
                'json' => $function->params(),
            ]
        )->getBody()->getContents();

        $content = StringHelp::checkC($content);

        return json_decode($content);
    }
}