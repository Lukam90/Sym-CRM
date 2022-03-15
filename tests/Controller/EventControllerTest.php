<?php

namespace App\Tests\Controller;

class EventControllerTest extends ControllerTest
{
    public function isSortOK($column)
    {
        $this->isOrderOK("events", $column, "asc");
        $this->isOrderOK("events", $column, "desc");
    }

    /** @test */
    public function events_list_should_display(): void
    {
        $this->isRouteOK('/events');
    }

    /** @test */
    public function contacts_sort_should_work(): void
    {
        $this->client = static::createClient();

        $this->isSortOK("id");
        $this->isSortOK("title");
        $this->isSortOK("type");
        $this->isSortOK("date");
    }

    /** @test */
    public function events_search_should_work(): void
    {
        $this->isSearchOK("events");
    }
}
