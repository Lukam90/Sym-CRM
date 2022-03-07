<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ControllerTest extends WebTestCase
{
    /**
     * @var
     */
    protected $client;

    public function sort($table, $column, $order)
    {
        $this->client->request('GET', "/$table/sort/$column/$order");

        $this->assertResponseStatusCodeSame(200);
    }

    /** @test */
    public function basic_class_should_work()
    {
        $this->assertTrue(true);
    }
}