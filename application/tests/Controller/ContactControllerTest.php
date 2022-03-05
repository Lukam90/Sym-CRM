<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    /** @test */
    public function contacts_list_should_display(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contacts');

        $this->assertResponseStatusCodeSame(200);
    }
}
