<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\TeamFormType;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TeamController extends AbstractController
{
    /**
     * @var TeamRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(TeamRepository $repository, EntityManagerInterface $entityManager) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

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
        if ($request->get("submit") && $this->isCsrfTokenValid("new", $request->get("_token"))) {
            $team = new Team;
            $team->setName($request->get("name"));

            $this->entityManager->persist($team);
            $this->entityManager->flush();

            $this->addFlash("success", "L'équipe a bien été ajoutée.");
        }

        return $this->redirectToRoute("teams");
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
        $team = $this->repository->find((int) $id);

        if (! $team) {
            $this->addFlash("danger", "L'équipe #$id n'a pas été trouvée.");
        }

        if ($request->get("submit") && $this->isCsrfTokenValid("edit", $request->get("_token"))) {
            $team->setName($request->get("name"));

            $this->entityManager->flush();

            $this->addFlash("success", "L'équipe a bien été éditée.");
        }

        return $this->redirectToRoute("teams");
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
        $team = $this->repository->find((int) $id);

        if (! $team) {
            $this->addFlash("danger", "L'équipe #$id n'a pas été trouvée.");
        }

        if ($this->isCsrfTokenValid("delete", $request->get("_token"))) {
            $this->entityManager->remove($team);
            $this->entityManager->flush();

            $this->addFlash('success', "L'équipe a bien été supprimée.");
        }

        return $this->redirectToRoute("teams");
    }
}
