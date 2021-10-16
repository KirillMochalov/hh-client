<?php


namespace HhClient;


use GuzzleHttp\Exception\GuzzleException;

class Client
{
    private $access_token;
    private $http_client;

    /**
     * Client constructor.
     * @param string $access_token
     */
    public function __construct(string $access_token)
    {
        $this->access_token = $access_token;
        $this->http_client = new \GuzzleHttp\Client([
            'base_uri' => 'https://api.hh.ru',
        ]);
    }

    /**
     * @param string $text
     * @param int $per_page
     * @param int $page
     * @return array|null
     * @throws GuzzleException
     */
    public function searchVacancies(string $text = '', int $per_page = 20, $page = 0): ?array
    {
        $response = $this->http_client->request(
            'GET',
            '/vacancies',
            [
                'headers' => $this->getHeaders(),
                'form_params' => [
                    'per_page' => $per_page,
                    'page' => $page,
                    'text' => $text,
                ]
            ],
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @param int $id
     * @return array|null
     * @throws GuzzleException
     */
    public function getVacancy(int $id): ?array
    {
        $response = $this->http_client->request(
            'GET',
            "/vacancies/$id",
            [
                'headers' => $this->getHeaders(),
            ],
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @return array|null
     * @throws GuzzleException
     */
    public function getDictionaries(): ?array
    {
        $response = $this->http_client->request(
            'GET',
            '/dictionaries',
            [
                'headers' => $this->getHeaders(),
            ],
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @return array|null
     * @throws GuzzleException
     */
    public function getResumes(): ?array
    {
        $response = $this->http_client->request(
            'GET',
            '/resumes/mine',
            [
                'headers' => $this->getHeaders(),
            ],
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @return array|null
     * @throws GuzzleException
     */
    public function getAreas(): ?array
    {
        $response = $this->http_client->request(
            'GET',
            '/areas',
            [
                'headers' => $this->getHeaders(),
            ],
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @param Resume $resume
     * @return mixed
     * @throws GuzzleException
     */
    public function createResume(Resume $resume)
    {
        $response = $this->http_client->request(
            'POST',
            '/resumes',
            [
                'headers' => $this->getHeaders(),
                'body' => json_encode($resume),
            ],
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @return array|null
     * @throws GuzzleException
     */
    public function getPhotoArtefacts(): ?array
    {
        $response = $this->http_client->request(
            'GET',
            '/artifacts/photo',
            [
                'headers' => $this->getHeaders(),
            ],
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @return array|null
     * @throws GuzzleException
     */
    public function getPortfolioArtefacts(): ?array
    {
        $response = $this->http_client->request(
            'GET',
            '/artifacts/portfolio',
            [
                'headers' => $this->getHeaders(),
            ],
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @param string $type
     * @param $file
     * @param string|null $description
     * @return array|null
     * @throws GuzzleException
     */
    public function uploadArtefact(string $type, $file, ?string $description = null): ?array
    {
        $response = $this->http_client->request(
            'POST',
            '/artifacts',
            [
                'headers' => $this->getHeaders(),
                'form_params' => [
                    'type' => $type,
                    'description' => $description,
                    'file' => $file,
                ]
            ],
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @return string[]
     */
    private function getHeaders(): array
    {
        return ['Authorization' => "Bearer $this->access_token"];
    }

}
