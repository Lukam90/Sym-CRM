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

            $this->addFlash("success", "Objet ajouté avec succès");
        } else {
            $this->addFlash("danger", "Erreur lors de l'ajout.");
        }

        return $this->redirectToRoute("teams");
    }

    /**
     * @Route("/teams/edit/{id}", name="teams.edit")
     * 
     * @param Team $team
     * @param Request $request
     * 
     * @return Response
     */
    public function edit(Team $team, Request $request): Response
    {
        $form = $this->createForm(TeamFormType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            $this->addFlash("success", "Equipe éditée avec succès.");

            return $this->redirectToRoute("teams");
        }

        return $this->render('teams/form_teams.html.twig', [
            'title' => "Edition d'une équipe",
            "team" => $team,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/teams/delete/{id}", name="teams.delete")
     * 
     * @param Team $team
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function delete(Team $team, Request $request): Response {
        if ($this->isCsrfTokenValid("delete" . $team->getId(), $request->get("_token"))) {
            $this->entityManager->remove($team);
            $this->entityManager->flush();

            $this->addFlash('success', "L'équipe a bien été supprimée !");
        }

        return $this->redirectToRoute("teams");
    }
}
