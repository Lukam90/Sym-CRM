<?php

namespace App\Tests\Controller;

use Symfony\Component\Panther\PantherTestCase;

class TeamControllerTest extends PantherTestCase
{
    public function testSomething(): void
    {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/');

        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
