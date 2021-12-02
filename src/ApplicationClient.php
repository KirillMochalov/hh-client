<?php

namespace HhClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use UnexpectedValueException;

/**
 * ApplicationClient
 * @property string $client_id
 * @property string $client_secret
 * @property Client $http_client
 */
class ApplicationClient
{
    /**
     * @var string
     */
    protected $client_id;
    /**
     * @var string
     */
    protected $client_secret;
    /**
     * @var Client
     */
    protected $http_client;

    /**
     * @var string|null
     */
    protected $application_token;

    /**
     * ApplicationClient constructor.
     * @param string $client_id
     * @param string $client_secret
     * @param string $application_token
     */
    public function __construct(string $client_id, string $client_secret, ?string $application_token = null)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->application_token = $application_token;

        $this->http_client = new Client([
            'base_uri' => 'https://api.hh.ru',
        ]);
    }

    /**
     * @return string|null
     */
    public function getApplicationToken(): ?string
    {
        return $this->application_token;
    }

    /**
     * @param string|null $application_token
     */
    public function setApplicationToken(?string $application_token): void
    {
        $this->application_token = $application_token;
    }

    /**
     * @return string|null
     * @throws GuzzleException
     */
    public function generateApplicationToken(): ?string
    {
        $client = new Client([
            'base_uri' => 'https://hh.ru'
        ]);

        $response = $client->request(
            'POST',
            '/oauth/token',
            [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->client_id,
                    'client_secret' => $this->client_secret,
                ]
            ]
        )->getBody()->getContents();

        return json_decode($response, true)['access_token'] ?? null;
    }

    /**
     * @param string $login
     * @param string $first_name
     * @param string $last_name
     * @param string|null $middle_name
     * @return array|null
     * @throws GuzzleException
     * @throws UnexpectedValueException
     */
    public function createUser(
        string $login,
        string $first_name,
        string $last_name,
        ?string $middle_name = null
    ): ?array {
        if (empty($this->application_token)) {
            throw new UnexpectedValueException("Invalid application token");
        }

        $body = [
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'login' => $login,
        ];

        if (!empty($middle_name)) {
            $body['middle_name'] = $middle_name;
        }

        $response = $this->http_client->request(
            'POST',
            '/users',
            [
                'headers' => [
                    'Authorization' => "Bearer $this->application_token"
                ],
                'form_params' => $body,
            ],
        )->getBody()->getContents();

        return json_decode($response, true);
    }

}
