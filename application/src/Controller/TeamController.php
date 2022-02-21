<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    /**
     * @Route("/teams", name="teams")
     */
    public function index(): Response
    {
        return $this->render('teams/list_teams.html.twig', [
            'title' => 'Liste des équipes',
        ]);
    }

    /**
     * @Route("/teams/add", name="add_team")
     */
    public function add(): Response
    {
        return $this->render('teams/form_teams.html.twig', [
            'title' => "Ajout d'une équipe",
        ]);
    }

    /**
     * @Route("/teams/edit/{id}", name="edit_team")
     */
    public function edit(): Response
    {
        return $this->render('teams/form_teams.html.twig', [
            'title' => "Edition d'une équipe",
        ]);
    }

    /**
     * @Route("/teams/delete/{id}", name="delete_team")
     */
    public function delete(): Response
    {
        return $this->render('team/index.html.twig', [
            'controller_name' => 'TeamController',
        ]);
    }
}
