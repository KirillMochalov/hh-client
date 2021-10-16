<?php


namespace HhClient\OAuth;


class OAuthResponse
{
    private $access_token;
    private $token_type;
    private $expires_in;
    private $refresh_token;

    public function __construct(
        string $access_token,
        string $token_type,
        int $expires_in,
        string $refresh_token
    ) {
        $this->access_token = $access_token;
        $this->token_type = $token_type;
        $this->expires_in = $expires_in;
        $this->refresh_token = $refresh_token;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->token_type;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expires_in;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refresh_token;
    }

}
