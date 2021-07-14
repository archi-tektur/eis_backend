<?php

declare(strict_types=1);

namespace Tests\Application;

use App\Infrastructure\Symfony\Controller\UserController;
use Tests\Utilities\ApiTestCase;

/**
 * Tests user ability to log in and check its data
 *
 * @see UserController
 */
class UserControllerTest extends ApiTestCase
{
    public function testLogInWithCorrectCredentials(): void
    {
        $input = [
            'username' => 'generic1@example.com',
            'password' => 'generic1',
        ];

        $response = $this->request('POST', 'api/v1/login', $input);

        self::assertSame(200, $response->getStatusCode());
        self::assertJson($response->getContent());

        $output = json_decode($response->getContent(), true);

        self::assertArrayHasKey('token', $output);
        self::assertIsString($output['token']);
    }

    public function testLogInWithIncorrectCredentials(): void
    {
        $input = [
            'username' => 'generic1@example.com',
            'password' => 'some-incorrect-password',
        ];

        $response =$this->request('POST', 'api/v1/login', $input);

        self::assertSame(401, $response->getStatusCode());
        self::assertJson($response->getContent());

        $output = json_decode($response->getContent(), true);

        self::assertArrayHasKey('message', $output);
        self::assertSame('Invalid credentials.', $output['message']);
    }
}