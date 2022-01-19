<?php

namespace HhClient;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

/**
 * ApplicantClient
 * @property string $access_token
 * @property Client $http_client
 */
class ApplicantClient
{
    /**
     * @var string
     */
    protected $access_token;

    /**
     * @var GuzzleClient
     */
    protected $http_client;

    /**
     * @var string
     */
    private $user_agent = '';

    /**
     * ApplicantClient constructor.
     * @param string $access_token
     */
    public function __construct(string $access_token)
    {
        $this->access_token = $access_token;
        $this->http_client = new GuzzleClient([
            'base_uri' => 'https://api.hh.ru'
        ]);
    }

    /**
     * Поиск по вакансиям
     * https://github.com/hhru/api/blob/master/docs/vacancies.md#поиск-по-вакансиям
     * @param array $params
     * @param int $per_page
     * @param int $page
     * @return array|null
     * @throws GuzzleException
     */
    public function searchVacancies(array $params = [], int $per_page = 20, $page = 0): ?array
    {
        $params['per_page'] = $per_page;
        $params['page'] = $page;

        $query = [];
        foreach ($params as $k=>$v) {
            if (is_string($v)) {
                $query[] = "{$k}={$v}";
            }
            if (is_array($v)) {
                foreach ($v as $vv) {
                    $query[] = "{$k}={$vv}";
                }
            }
        }

        $response = $this->http_client->request(
            'GET',
            '/vacancies?' . implode('&',$query),
            [
                'headers' => $this->getHeaders()
            ]
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
            ]
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
            ]
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @param int $per_page
     * @param int $page
     * @return array|null
     * @throws GuzzleException
     */
    public function getResumes(int $per_page = 20, int $page = 0): ?array
    {
        $response = $this->http_client->request(
            'GET',
            '/resumes/mine',
            [
                'headers' => $this->getHeaders(),
                'form_params' => [
                    'per_page' => $per_page,
                    'page' => $page,
                ]
            ]
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @param string $id
     * @return array|null
     * @throws GuzzleException
     */
    public function getResume(string $id): ?array
    {
        $response = $this->http_client->request(
            'GET',
            "/resumes/$id",
            [
                'headers' => $this->getHeaders(),
            ]
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @param string $id
     * @return array|null
     * @throws GuzzleException
     */
    public function deleteResume(string $id): ?array
    {
        $response = $this->http_client->request(
            'DELETE',
            "/resumes/$id",
            [
                'headers' => $this->getHeaders(),
            ]
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @param string $id
     * @return array|null
     * @throws GuzzleException
     */
    public function publishResume(string $id): ?array
    {
        $response = $this->http_client->request(
            'POST',
            "/resumes/$id/publish",
            [
                'headers' => $this->getHeaders(),
            ]
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
            ]
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @return array|null
     * @throws GuzzleException
     */
    public function getProfessionalRoles(): ?array
    {
        $response = $this->http_client->request(
            'GET',
            '/professional_roles',
            [
                'headers' => $this->getHeaders(),
            ]
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @return array|null
     * @throws GuzzleException
     */
    public function getNewResumeConditions(): ?array
    {
        $response = $this->http_client->request(
            'GET',
            '/resume_conditions',
            [
                'headers' => $this->getHeaders(),
            ]
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @param string $id
     * @return array|null
     * @throws GuzzleException
     */
    public function getResumeConditions(string $id): ?array
    {
        $response = $this->http_client->request(
            'GET',
            "/resumes/$id/conditions",
            [
                'headers' => $this->getHeaders(),
            ]
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @param Resume $resume
     * @return bool
     * @throws GuzzleException
     */
    public function createResume(Resume $resume): bool
    {
        $response = $this->http_client->request(
            'POST',
            '/resumes',
            [
                'headers' => $this->getHeaders(),
                'body' => json_encode($resume),
            ]
        );

        return $response->getStatusCode() == 201;
    }

    /**
     * @param string $id
     * @param Resume $resume
     * @return bool
     * @throws GuzzleException
     */
    public function updateResume(string $id, Resume $resume): bool
    {
        $response = $this->http_client->request(
            'PUT',
            "/resumes/$id",
            [
                'headers' => $this->getHeaders(),
                'body' => json_encode($resume),
            ]
        );

        return $response->getStatusCode() == 204;
    }

    /**
     * @param int $per_page
     * @param int $page
     * @return array|null
     * @throws GuzzleException
     */
    public function getPhotoArtefacts(int $per_page = 20, int $page = 0): ?array
    {
        $response = $this->http_client->request(
            'GET',
            '/artifacts/photo',
            [
                'headers' => $this->getHeaders(),
                'form_params' => [
                    'per_page' => $per_page,
                    'page' => $page,
                ]
            ]
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
            ]
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
            ]
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @return array|null
     * @throws GuzzleException
     */
    public function getSpecializations(): ?array
    {
        $response = $this->http_client->request(
            'GET',
            '/specializations',
            [
                'headers' => $this->getHeaders(),
            ]
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @return array|null
     * @throws GuzzleException
     */
    public function getLanguages(): ?array
    {
        $response = $this->http_client->request(
            'GET',
            '/languages',
            [
                'headers' => $this->getHeaders(),
            ]
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @return array|null
     * @throws GuzzleException
     */
    public function getMetros(): ?array
    {
        $response = $this->http_client->request(
            'GET',
            '/metro',
            [
                'headers' => $this->getHeaders(),
            ]
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @return array|null
     * @throws GuzzleException
     */
    public function getLocales(): ?array
    {
        $response = $this->http_client->request(
            'GET',
            '/locales',
            [
                'headers' => $this->getHeaders(),
            ]
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @return array|null
     * @throws GuzzleException
     */
    public function getApplicantAgreement(): ?array
    {
        $response = $this->http_client->request(
            'GET',
            '/documents/applicant_agreement',
            [
                'headers' => $this->getHeaders(),
            ]
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @return array|null
     * @throws GuzzleException
     */
    public function getEmployerAgreement(): ?array
    {
        $response = $this->http_client->request(
            'GET',
            '/documents/employer_agreement',
            [
                'headers' => $this->getHeaders(),
            ]
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * Информация о соискателе
     * @return array|null
     * @throws GuzzleException
     */
    public function getMe(): ?array
    {
        $response = $this->http_client->request(
            'GET',
            '/me',
            [
                'headers' => $this->getHeaders(),
            ]
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * Установить заголовок HH-User-Agent
     * @param $user_agent
     */
    public function setUserAgent($user_agent)
    {
        $this->user_agent = $user_agent;
    }

    /**
     * @return string[]
     */
    private function getHeaders(): array
    {
        return [
            'Authorization' => "Bearer $this->access_token",
            'HH-User-Agent' => $this->user_agent
        ];
    }

}
