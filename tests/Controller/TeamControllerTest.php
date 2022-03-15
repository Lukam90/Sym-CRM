<?php

namespace App\Tests\Controller;

class TeamControllerTest extends ControllerTest
{
    public function isSortOK($column)
    {
        $this->isOrderOK("teams", $column, "asc");
        $this->isOrderOK("teams", $column, "desc");
    }

    /** @test */
    public function teams_list_should_display(): void
    {
        $this->isRouteOK('/teams');
    }

    /** @test */
    public function teams_sort_should_work(): void
    {
        $this->client = static::createClient();

        $this->isSortOK("id");
        $this->isSortOK("name");
    }

    /** @test */
    public function teams_search_should_work(): void
    {
        $this->isSearchOK("teams");
    }
}
