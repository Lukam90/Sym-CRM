<?php

namespace App\Traits;

use App\Entity\Team;
use Symfony\Component\HttpFoundation\Response;

trait TeamTrait
{
    /**
     * Displays an error if an team is not found
     * 
     * @param Team $team
     * 
     */
    public function isNotFound(Team $team) 
    {
        if (! $team) {
            $this->addError("L'événement n'a pas été trouvé.");
        }
    }

    /**
     * Get an team with an ID
     * 
     * @param $id
     * 
     * @return Team
     */
    public function getTeam($id) 
    {
        return $this->repository->find((int) $id);
    }

    /**
     * Set form value
     * 
     * @param Team $team
     */
    public function setFormValue(Team $team) 
    {
        $team->setName($this->getRequest()->get("name"));
    }

    /**
     * Render the list of teams
     * 
     * @param Team[] $teams
     * 
     * @return Response
     */
    public function renderList($teams) : Response
    {
        return $this->render('pages/teams/list_teams.html.twig', [
            'title' => 'Liste des équipes',
            'teams' => $teams,
        ]);
    }
}