<?php

namespace App\Tests\Controller;

class TeamControllerTest extends ControllerTest
{
    public function sortColumn($column)
    {
        $this->sort("teams", $column, "asc");
        $this->sort("teams", $column, "desc");
    }

    /** @test */
    public function teams_list_should_display(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/teams');

        $this->assertResponseStatusCodeSame(200);
    }

    /** @test */
    public function teams_sort_should_work(): void
    {
        $this->client = static::createClient();

        $this->sortColumn("id");
        $this->sortColumn("name");
    }
}
