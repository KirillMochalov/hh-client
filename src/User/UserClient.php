<?php


namespace HhClient\User;


use GuzzleHttp\Client;

class UserClient
{
    /**
     * @var string
     */
    private $client_id;
    /**
     * @var string
     */
    private $client_secret;
    /**
     * @var Client
     */
    private $http_client;
    /**
     * @var string
     */
    private $user_agent;

    /**
     * UserClient constructor.
     * @param string $client_id
     * @param string $client_secret
     */
    public function __construct(string $client_id, string $client_secret, string $user_agent)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->user_agent = $user_agent;
        $this->http_client = new Client([
            'base_uri' => 'https://api.hh.ru',
        ]);
    }

    /**
     * @param string $login
     * @param string $first_name
     * @param string $last_name
     * @param string|null $middle_name
     * @return array|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createUser(
        string $login,
        string $first_name,
        string $last_name,
        ?string $middle_name = null
    ): ?array {
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
                    'User-Agent' => $this->user_agent,
                ],
                'form_params' => $body,
            ],
        )->getBody()->getContents();

        return json_decode($response, true);
    }

}
