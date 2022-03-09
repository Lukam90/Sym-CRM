<?php

namespace App\Tests\Controller;

class ContactControllerTest extends ControllerTest
{
    public function isSortOK($column)
    {
        $this->sort("contacts", $column, "asc");
        $this->sort("contacts", $column, "desc");
    }

    /** @test */
    public function contacts_list_should_display(): void
    {
        $this->isRouteOK('/contacts');
    }

    /** @test */
    public function contacts_sort_should_work(): void
    {
        $this->client = static::createClient();

        $this->isSortOK("id");
        $this->isSortOK("fullName");
        $this->isSortOK("type");
        $this->isSortOK("role");
    }

    /** @test */
    public function contacts_search_should_work(): void
    {
        $this->isSearchOK("contacts");
    }
}
