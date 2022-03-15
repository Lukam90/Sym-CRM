<?php

namespace App\Tests\Controller;

class ContactControllerTest extends ControllerTest
{
    public function isSortOK($column)
    {
        $this->isOrderOK("contacts", $column, "asc");
        $this->isOrderOK("contacts", $column, "desc");
    }

    /** @test */
    public function contacts_list_should_display(): void
    {
        $this->isRouteOK('/contacts');
    }

    /** @test */
    public function contacts_isOrderOK_should_work(): void
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

    /** @test */
    public function new_contact_route_should_work(): void
    {
        $this->isRedirectionOK("/contacts/new", "post");
    }

    /** @test */
    public function edit_contact_route_should_work(): void
    {
        $this->isRedirectionOK("/contacts/edit/1", "post");
    }
}
