<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ControllerTest extends WebTestCase
{
    /**
     * @var
     */
    protected $client;

    /**
     * Gets a route with the GET method and a URL
     * 
     * @param string $url
     */
    public function get($url)
    {
        return $this->client->request('GET', $url);
    }

    /**
     * Checkes if a route is OK
     */
    public function isRouteOK($url)
    {
        $this->client = static::createClient();

        $crawler = $this->get($url);

        $this->assertResponseStatusCodeSame(200);
    }

    /**
     * Sorts a table
     * 
     * @param string $table
     * @param string $column
     * @param string $order
     */
    public function sort($table, $column, $order)
    {
        $crawler = $this->get("/$table/sort/$column/$order");

        $this->assertResponseStatusCodeSame(200);
    }

    /**
     * Tests a search route
     * 
     * @param string $table
     */
    public function isSearchOK($table)
    {
        $this->isRouteOK("/$table/search");
    }

    /** @test */
    public function basic_class_should_work()
    {
        $this->assertTrue(true);
    }
}