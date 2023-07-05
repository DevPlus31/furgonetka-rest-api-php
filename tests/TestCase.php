<?php

declare(strict_types=1);

namespace Kwarcek\FurgonetkaRestApi\Test;

use Faker\Factory;
use Faker\Generator;
use GuzzleHttp\Client;
use Kwarcek\FurgonetkaRestApi\FurgonetkaClient;
use Kwarcek\FurgonetkaRestApi\LoginCredential;
use Kwarcek\FurgonetkaRestApi\Test\Helpers\RequestHelper;
use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * Class TestCase
 * @package Kwarcek\FurgonetkaRestApi\Test
 */
abstract class TestCase extends BaseTestCase
{
    public const DEFAULT_CARRIER = 'dpd';

    public RequestHelper $helper;
    public FurgonetkaClient $client;
    public Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = $this->getFurgonetkaClient();
        $this->helper = new RequestHelper($this->client);
        $this->faker = Factory::create();
    }

    private function getFurgonetkaClient(): FurgonetkaClient
    {
        $credentials = new LoginCredential();
        $credentials->clientSecret = getenv('FURGONETKA_CLIENT_SECRET');
        $credentials->clientId = getenv('FURGONETKA_CLIENT_ID');
        $credentials->username = getenv('FURGONETKA_USERNAME');
        $credentials->password = getenv('FURGONETKA_PASSWORD');

        return new FurgonetkaClient($this->getGuzzleClient(), $credentials);
    }

    private function getGuzzleClient(): Client
    {
        return new Client([
            'base_uri' => LoginCredential::FURGONETKA_DEFAULT_TEST_API_URL,
            'timeout' => 10,
            'verify' => false,
        ]);
    }
}