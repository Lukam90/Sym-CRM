<?php

namespace App\Tests\Controller;

class EventControllerTest extends ControllerTest
{
    public function sortColumn($column)
    {
        $this->sort("events", $column, "asc");
        $this->sort("events", $column, "desc");
    }

    /** @test */
    public function events_list_should_display(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/events');

        $this->assertResponseStatusCodeSame(200);
    }

    /** @test */
    public function contacts_sort_should_work(): void
    {
        $this->client = static::createClient();

        $this->sortColumn("id");
        $this->sortColumn("title");
        $this->sortColumn("type");
        $this->sortColumn("date");
    }
}
