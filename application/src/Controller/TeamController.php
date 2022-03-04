<?php

namespace App\Controller;

use App\Entity\Team;
use App\Controller\AppController;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;

class TeamController extends AppController
{
    /* Constructor */

    public function __construct(TeamRepository $repository, EntityManagerInterface $entityManager, RequestStack $requestStack) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

    /* Utilities */

    /**
     * Displays an error if an team is not found
     * 
     * @param Team $team
     * 
     */
    public function isNotFound(Team $team) {
        if (! $team) {
            $this->addError("L'événement #$id n'a pas été trouvé.");
        }
    }

    /**
     * Get an team with an ID
     * 
     * @param $id
     * 
     * @return Team
     */
    public function getTeam($id) {
        return $this->repository->find((int) $id);
    }

    /**
     * Set form value
     * 
     * @param Team $team
     */
    public function setFormValue(Team $team) {
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
        return $this->render('teams/list_teams.html.twig', [
            'title' => 'Liste des équipes',
            'teams' => $teams,
        ]);
    }

    /* CRUD */

    /**
     * @Route("/teams", name="teams")
     * 
     * @return Response
     */
    public function index(): Response
    {
        $teams = $this->getAll();

        return $this->render('teams/list_teams.html.twig', [
            'title' => 'Liste des équipes',
            'teams' => $teams
        ]);
    }

    /**
     * @Route("/teams/sort/{column}", name="teams.sort")
     * 
     * @param string $column
     * 
     * @return Response
     */
    public function sort(string $column): Response {
        $teams = $this->repository->findSorted($column);

        return $this->renderList($teams);
    }

    /**
     * @Route("/teams/search", name="teams.search")
     * 
     * @return Response
     */
    public function search(): Response {
        $name = $this->getRequest()->get("filter");

        $teams = $this->repository->findByName($name);

        return $this->renderList($teams);
    }

    /**
     * @Route("/teams/new", name="teams.new")
     * 
     * @return Response
     */
    public function new(): Response 
    {
        if ($this->isFormValid("new")) {
            $team = new Team;
            
            $this->setFormValue($team);

            $this->entityManager->persist($team);
            $this->entityManager->flush();

            $this->addSuccess("L'équipe a bien été ajoutée.");
        } else {
            $this->addError();
        }

        return $this->redirectToRoute("teams");
    }

    /**
     * @Route("/teams/edit/{id}", name="teams.edit")
     * 
     * @param $id
     * 
     * @return Response
     */
    public function edit($id): Response {
        $team = $this->getTeam($id);

        $this->isNotFound($team);

        if ($this->isFormValid("edit")) {
            $this->setFormValue($team);

            $this->entityManager->flush();

            $this->addSuccess("L'équipe a bien été éditée.");
        } else {
            $this->addError();
        }

        return $this->redirectToRoute("teams");
    }

    /**
     * @Route("/teams/delete/{id}", name="teams.delete")
     * 
     * @param $id
     * 
     * @return Response
     */
    public function delete($id): Response {
        $team = $this->getTeam($id);

        $this->isNotFound($team);

        if ($this->isTokenValid("delete")) {
            $this->entityManager->remove($team);
            $this->entityManager->flush();

            $this->addSuccess("L'équipe a bien été supprimée.");
        } else {
            $this->addError();
        }

        return $this->redirectToRoute("teams");
    }
}
