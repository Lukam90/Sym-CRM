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

    /** @test */
    public function new_team_form_should_work(): void
    {
        $this->client = static::createClient();

        $crawler = $this->get("/teams");

        $link = $crawler->filter("#new-button")->link();

        $this->client->click($link);

        $this->assertSelectorExists(".is-active");
        $this->assertSelectorExists("#modal-form");

        $token = $crawler->filter("#modal-token")->attr("value");
        $action = $crawler->filter("#modal-token")->attr("action");

        var_dump($token, $action);

        $this->client->submitForm("Valider", [
            "name" => "Equipe de test"
            //"_token"
        ]);

        //$this->assertResponseRedirects();
    }
}
