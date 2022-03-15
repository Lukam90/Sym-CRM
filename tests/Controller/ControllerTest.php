<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ControllerTest extends WebTestCase
{
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
     * Gets a route with the POST method and a URL
     * 
     * @param string $url
     */
    public function post($url)
    {
        return $this->client->request('POST', $url);
    }

    /**
     * Checkes if a route is OK
     * 
     * @param string $url
     * @param string $method = "GET"
     */
    public function isRouteOK($url, $method = "get")
    {
        $this->client = static::createClient();

        $crawler = $this->$method($url);

        $this->assertResponseStatusCodeSame(200);
    }

    /**
     * Checkes if a redirection is OK
     * 
     * @param string $url
     * @param string $method = "GET"
     */
    public function isRedirectionOK($url, $method = "get")
    {
        $this->client = static::createClient();

        $crawler = $this->$method($url);

        $this->assertResponseRedirects();
    }

    /**
     * Sorts a table
     * 
     * @param string $table
     * @param string $column
     * @param string $order
     */
    public function isOrderOK($table, $column, $order)
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

    /**
     * Simple test
     */
    public function testSimple() {
        $this->assertTrue(true);
    }
}