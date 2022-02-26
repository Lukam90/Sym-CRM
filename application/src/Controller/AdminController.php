<?php

namespace App\Controller;

use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        $stats = [
            [
                "number" => 25,
                "type" => "utilisateur(s)",
                "color" => "info"
            ],
            [
                "number" => 32,
                "type" => "équipe(s)",
                "color" => "success"
            ],
            [
                "number" => 14,
                "type" => "événement(s)",
                "color" => "danger"
            ],
            [
                "number" => 40,
                "type" => "contact(s)",
                "color" => "warning"
            ]
        ];

        $lastContacts = [
            ["fullName" => "Jean Dupont", "createdAt" => new DateTime()],
            ["fullName" => "Martin Laval", "createdAt" => new DateTime()],
            ["fullName" => "René Durand", "createdAt" => new DateTime()],
            ["fullName" => "Michel Boulanger", "createdAt" => new DateTime()],
            ["fullName" => "Victor Legrand", "createdAt" => new DateTime()],
        ];

        return $this->render('admin/dashboard.html.twig', [
            'title' => 'Tableau de bord',
            "stats" => $stats,
            "contacts" => $lastContacts
        ]);
    }
}
