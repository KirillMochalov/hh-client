<?php

namespace HhClient\OAuth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class OAuthClient
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
     * @var string
     */
    private $redirect_uri;
    /**
     * @var Client
     */
    private $http_client;

    /**
     * OAuthClient constructor.
     * @param string $client_id
     * @param string $client_secret
     * @param string $redirect_uri
     */
    public function __construct(string $client_id, string $client_secret, string $redirect_uri)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->redirect_uri = $redirect_uri;
        $this->http_client = new Client([
            'base_uri' => 'https://hh.ru'
        ]);
    }

    /**
     * @return String
     */
    public function getAuthenticationUrl(): String
    {
        return "https://hh.ru/oauth/authorize"
        . "?response_type=code"
        . "&client_id=$this->client_id"
        . "&redirect_uri=$this->redirect_uri";
    }

    /**
     * @param string $code
     * @return OAuthResponse
     * @throws GuzzleException
     */
    public function oAuth(string $code): OAuthResponse
    {
        $response = $this->http_client->request('POST', '/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'code' => $code,
                'redirect_uri' => $this->redirect_uri,
            ]
        ]);

        $json = json_decode($response->getBody()->getContents(), true);

        return new OAuthResponse(
            $json['access_token'],
            $json['token_type'],
            $json['expires_in'],
            $json['refresh_token']
        );
    }

    /**
     * @param string $refreshToken
     * @return OAuthResponse
     * @throws GuzzleException
     */
    public function refreshToken(string $refreshToken): OAuthResponse
    {
        $response = $this->http_client->request('POST', '/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
            ]
        ]);

        $json = json_decode($response->getBody()->getContents(), true);

        return new OAuthResponse(
            $json['access_token'],
            $json['token_type'],
            $json['expires_in'],
            $json['refresh_token']
        );
    }
}
