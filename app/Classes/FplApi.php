<?php

namespace App\Classes;



use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class FplApi
{

    CONST BASE_URL = 'https://fantasy.premierleague.com/';
    CONST AUTH_URL = 'https://users.premierleague.com/accounts/';

    protected $client;
    protected $authClient;
    protected $cookieJar;

    public function __construct()
    {
        try{
            $this->cookieJar= new CookieJar;
            $this->client = new Client([
                'headers' => ['User-Agent' => 'FplApi/1.0','Content-Type'=>'application/x-www-form-urlencoded'],
                'cookies' => $this->cookieJar,
                'http_errors' => false,
            ]);
            $this->authClient = new GuzzleClient($this->client, self::getAuthOperations());
            $this->client = new GuzzleClient($this->client, self::getGeneralOperations());
        }catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }
    }

    public static function getGeneralOperations()
    {
        $description = new Description(
            [
                'baseUri' => self::BASE_URL,
                'cookies' => true,
                'operations' => [
                    'bootstrapStatic' => [
                        'httpMethod' => 'GET',
                        'uri' => '/api/bootstrap-static/',
                        'responseModel' => 'getResponse',
                    ],
                    'me' => [
                        'httpMethod' => 'GET',
                        'uri' => '/api/me/',
                        'responseModel' => 'getResponse',
                    ],
                    'entry' => [
                        'httpMethod' => 'GET',
                        'uri' => '/api/entry/{entryId}/',
                        'responseModel' => 'getResponse',
                        'parameters' => [
                            'entryId' => [
                                'type' => 'string',
                                'location' => 'uri',
                            ],
                        ],
                    ],
                    'entryHistory' => [
                        'httpMethod' => 'GET',
                        'uri' => '/api/entry/{entryId}/history/',
                        'responseModel' => 'getResponse',
                        'parameters' => [
                            'entryId' => [
                                'type' => 'string',
                                'location' => 'uri',
                            ],
                        ],
                    ],
                    'entryPicks' => [
                        'httpMethod' => 'GET',
                        'uri' => '/api/entry/{entryId}/event/{eventId}/picks/',
                        'responseModel' => 'getResponse',
                        'parameters' => [
                            'entryId' => [
                                'type' => 'string',
                                'location' => 'uri',
                            ],
                            'eventId' => [
                                'type' => 'string',
                                'location' => 'uri',
                            ],
                        ],
                    ],
                    'elementSummary' => [
                        'httpMethod' => 'GET',
                        'uri' => '/api/element-summary/{elementId}/',
                        'responseModel' => 'getResponse',
                        'parameters' => [
                            'elementId' => [
                                'type' => 'string',
                                'location' => 'uri',
                            ],
                        ],
                    ],
                    'leaguesClassicStandings' => [
                        'httpMethod' => 'GET',
                        'uri' => '/api/leagues-classic-standings/{leagueId}/',
                        'responseModel' => 'getResponse',
                        'parameters' => [
                            'leagueId' => [
                                'type' => 'string',
                                'location' => 'uri',
                            ],
                        ],
                    ],
                    'fixtures' => [
                        'httpMethod' => 'GET',
                        'uri' => '/api/fixtures/?event={event}',
                        'responseModel' => 'getResponse',
                        'parameters' => [
                            'event' => [
                                'type' => 'string',
                                'location' => 'uri',
                            ],
                        ],
                    ],
                ],
                'models' => [
                    'getResponse' => [
                        'type' => 'object',
                        'additionalProperties' => ['location' => 'json'],
                    ],
                    "getRawResponse"=> [
                        "type"=> "object",
                        "properties"=> [
                            "body"=> [
                                "location"=> "body",
                                "type"=> "string"
                            ]
                        ]
                    ]
                ],
            ]
        );
        return $description;
    }

    public function getAuthOperations(){
        $description = new Description(
            [
                'baseUri' => self::AUTH_URL,
                'cookies' => true,
                'operations' => [
                    'login' => [
                        'httpMethod' => 'POST',
                        'uri' => 'login/',
                        'responseModel' => 'getRawResponse',
                        'parameters'=>[
                            'password'=>[
                                'type' => 'string',
                                'location' => 'body',
                            ],
                            'login'=>[
                                'type' => 'string',
                                'location' => 'body',
                            ],
                            'redirect_uri'=>[
                                'type' => 'string',
                                'location' => 'body',
                            ],
                            'app'=>[
                                'type' => 'string',
                                'location' => 'body',
                            ]
                        ]
                    ],
                    'logout' => [
                        'httpMethod' => 'POST',
                        'uri' => '/api/entry/{entryId}/',
                        'responseModel' => 'getResponse',
                        'parameters' => [
                            'entryId' => [
                                'type' => 'string',
                                'location' => 'uri',
                            ],
                        ],
                    ],
                ],
                'models' => [
                    'getResponse' => [
                        'type' => 'object',
                        'additionalProperties' => ['location' => 'json'],
                    ],
                    "getRawResponse"=> [
                        "type"=> "object",
                        "properties"=> [
                            "body"=> [
                                "location"=> "body",
                                "type"=> "string"
                            ]
                        ]
                    ]
                ],
            ]
        );
        return $description;
    }

    public function getClient(){
        return $this->client;
    }

    public function getAuthClient(){
        return $this->authClient;
        //$cookieJar = $this->authClient->getConfig('cookies');
        //return $cookieJar->toArray();
    }

    public function getCookies(){
        return $this->cookieJar;
    }
}
