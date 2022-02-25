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

    /* CRUD */

    /**
     * @Route("/teams", name="teams")
     * 
     * @return Response
     */
    public function index(): Response
    {
        $teams = $this->repository->findAll();

        return $this->render('teams/list_teams.html.twig', [
            'title' => 'Liste des équipes',
            'teams' => $teams
        ]);
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
        }

        return $this->redirectToRoute("teams");
    }

    /**
     * @Route("/teams/delete/{id}", name="teams.delete")
     * 
     * @param int $id
     * 
     * @return Response
     */
    public function delete($id): Response {
        $team = $this->getTeam($id);

        $this->isNotFound($team);

        //if ($this->isCsrfTokenValid("delete", $request->get("_token"))) {
        if ($this->isFormValid("delete")) {
            $this->entityManager->remove($team);
            $this->entityManager->flush();

            $this->addSuccess("L'équipe a bien été supprimée.");
        }

        return $this->redirectToRoute("teams");
    }
}
