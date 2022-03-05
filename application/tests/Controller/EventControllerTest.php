<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventControllerTest extends WebTestCase
{
    /** @test */
    public function events_list_should_display(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/events');

        $this->assertResponseStatusCodeSame(200);
    }
}
