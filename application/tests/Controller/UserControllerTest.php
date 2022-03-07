<?php

namespace App\Tests\Controller;

class UserControllerTest extends ControllerTest
{
    public function isSortOK($column)
    {
        $this->sort("users", $column, "asc");
        $this->sort("users", $column, "desc");
    }
    
    /** @test */
    public function users_list_should_display(): void
    {
        $this->isRouteOK('/users');
    }

    /** @test */
    public function users_sort_should_work(): void
    {
        $this->client = static::createClient();

        $this->isSortOK("id");
        $this->isSortOK("fullName");
        $this->isSortOK("role");
        $this->isSortOK("created_at");
    }

    /** @test */
    public function users_search_should_work(): void
    {
        $this->isSearchOK("users");
    }
}
