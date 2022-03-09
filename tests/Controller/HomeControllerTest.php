<?php

namespace App\Tests\Controller;

class HomeControllerTest extends ControllerTest
{
    /** @test */
    public function home_login_page_should_display(): void
    {
        $this->isRouteOK("/");
    }

    /** @test */
    /*public function mentions_modal_should_display_and_close(): void
    {
        $this->client = static::createClient();

        $crawler = $this->get("/");

        $link = $crawler->selectLink("Mentions Légales")->link();

        $crawler = $this->client->click($link);

        $class = $crawler->filter("#mentions")->extract(["class"])[0];

        $this->assertSame("modal is-active", $class);

        var_dump($class);
    }*/
}
