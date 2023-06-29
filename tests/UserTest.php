<?php

namespace App\Tests;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    public function testUserCreate(): void
    {
        $client = HttpClient::create();

        $response = $client->request('POST', 'http://localhost:8000/api/users', [
            'json' => [
                  "firstname" => "Nouveau",
                  "lastname" => "Client",
                  "picture" => "testphoto.jpg",
                  "role" => "Vigile"
                ]
        ]);

        $statusCode = $response->getStatusCode();

        $this->assertEquals(201, $statusCode);
    }
}