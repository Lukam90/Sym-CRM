<?php

namespace App\Tests\Controller;

class ContactControllerTest extends ControllerTest
{
    public function sortColumn($column)
    {
        $this->sort("contacts", $column, "asc");
        $this->sort("contacts", $column, "desc");
    }

    /** @test */
    public function contacts_list_should_display(): void
    {
        $this->client = static::createClient();

        $crawler = $this->client->request('GET', '/contacts');

        $this->assertResponseStatusCodeSame(200);
    }

    /** @test */
    public function contacts_sort_should_work(): void
    {
        $this->client = static::createClient();

        $this->sortColumn("id");
        $this->sortColumn("fullName");
        $this->sortColumn("type");
        $this->sortColumn("role");
    }
}
