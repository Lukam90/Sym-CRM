<?php

namespace App\Controller;

use App\Entity\Team;
use App\Traits\TeamTrait;
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

    public function __construct(TeamRepository $repository, EntityManagerInterface $entityManager, RequestStack $requestStack) 
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

    /* Utilities */

    use TeamTrait;

    /* CRUD */

    /**
     * @Route("/teams", name="teams")
     * 
     * @return Response
     */
    public function index(): Response
    {
        $teams = $this->getAll();

        return $this->renderList($teams);
    }

    /**
     * @Route("/teams/sort/{column}/{order}", name="teams.sort")
     * 
     * @param string $column
     * @param string $order
     * 
     * @return Response
     */
    public function sort(string $column, string $order): Response 
    {
        $teams = $this->repository->findSorted($column, $order);

        return $this->renderList($teams);
    }

    /**
     * @Route("/teams/search", name="teams.search")
     * 
     * @return Response
     */
    public function search(): Response
    {
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

            $this->addSuccess("L'??quipe a bien ??t?? ajout??e.");
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
    public function edit($id): Response 
    {
        $team = $this->getTeam($id);

        $this->isNotFound($team);

        if ($this->isFormValid("edit")) {
            $this->setFormValue($team);

            $this->entityManager->flush();

            $this->addSuccess("L'??quipe a bien ??t?? ??dit??e.");
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
    public function delete($id): Response 
    {
        $team = $this->getTeam($id);

        $this->isNotFound($team);

        if ($this->isTokenValid("delete")) {
            $this->entityManager->remove($team);
            $this->entityManager->flush();

            $this->addSuccess("L'??quipe a bien ??t?? supprim??e.");
        } else {
            $this->addError();
        }

        return $this->redirectToRoute("teams");
    }
}
