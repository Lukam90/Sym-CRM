<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeamControllerTest extends WebTestCase
{
    /** @test */
    public function teams_list_should_display(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/teams');

        $this->assertResponseStatusCodeSame(200);
    }
}
