<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MiscControllerTest extends WebTestCase
{
    /** @test */
    public function gantt_diagram_should_display(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/gantt');

        $this->assertResponseStatusCodeSame(200);
    }

    /** @test */
    public function kanban_should_display(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/kanban');

        $this->assertResponseStatusCodeSame(200);
    }
}
