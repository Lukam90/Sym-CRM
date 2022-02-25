<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\TeamFormType;
use App\Controller\DataController;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TeamController extends DataController
{
    /**
     * @var TeamRepository
     */
    private $repository;

    public function __construct(TeamRepository $repository, EntityManagerInterface $entityManager) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * Displays an error if an team is not found
     * 
     * @param Team $team
     * 
     */
    public function isNotFound(Team $team) {
        if (! $team) {
            $this->addFlash("danger", "L'événement #$id n'a pas été trouvé.");
        }
    }

    /**
     * @param $id
     * 
     * Get an team with an ID
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
     * @param Request $request
     */
    public function setFormValue(Team $team, Request $request) {
        $team->setName($request->get("name"));
    }

    /**
     * @return Response
     */
    public function redirect() {
        return $this->redirectToRoute("teams");
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
     * @param Request $request
     * 
     * @return Response
     */
    public function new(Request $request): Response 
    {
        if ($this->isFormValid("new")) {
            $team = new Team;
            
            $this->setFormValue($team, $request);

            $this->entityManager->persist($team);
            $this->entityManager->flush();

            $this->addFlash("success", "L'équipe a bien été ajoutée.");
        }

        $this->redirect();
    }

    /**
     * @Route("/teams/edit/{id}", name="teams.edit")
     * 
     * @param int $id
     * @param Request $request
     * 
     * @return Response
     */
    public function edit($id, Request $request): Response {
        $team = $this->getTeam($id);

        $this->isNotFound($team);

        if ($this->isFormValid("edit")) {
            $this->setFormValue($team, $request);

            $this->entityManager->flush();

            $this->addFlash("success", "L'équipe a bien été éditée.");
        }

        $this->redirect();
    }

    /**
     * @Route("/teams/delete/{id}", name="teams.delete")
     * 
     * @param int $id
     * @param Request $request
     * 
     * @return Response
     */
    public function delete($id, Request $request): Response {
        $team = $this->getTeam($id);

        $this->isNotFound($team);

        //if ($this->isCsrfTokenValid("delete", $request->get("_token"))) {
        if ($this->isFormValid("delete")) {
            $this->entityManager->remove($team);
            $this->entityManager->flush();

            $this->addFlash('success', "L'équipe a bien été supprimée.");
        }

        $this->redirect();
    }
}
