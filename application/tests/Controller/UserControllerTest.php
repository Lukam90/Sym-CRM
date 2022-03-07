<?php

namespace App\Tests\Controller;

class UserControllerTest extends ControllerTest
{
    public function sortColumn($column)
    {
        $this->sort("users", $column, "asc");
        $this->sort("users", $column, "desc");
    }
    
    /** @test */
    public function users_list_should_display(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/users');

        $this->assertResponseStatusCodeSame(200);
    }

    /** @test */
    public function users_sort_should_work(): void
    {
        $this->client = static::createClient();

        $this->sortColumn("id");
        $this->sortColumn("fullName");
        $this->sortColumn("role");
        $this->sortColumn("created_at");
    }
}
