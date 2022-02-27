<?php

namespace App\Controller;

use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * Pluralize the stats
     */
    public function pluralize($stats) {
        $newStats = [];

        foreach ($stats as $stat) {
            if ($stat["number"] > 1) {
                $stat["type"] .= "s";
            }

            $newStats[] = $stat;
        }

        return $newStats;
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        $stats = [
            [
                "number" => 25,
                "type" => "utilisateur",
                "color" => "info"
            ],
            [
                "number" => 32,
                "type" => "équipe",
                "color" => "success"
            ],
            [
                "number" => 14,
                "type" => "événement",
                "color" => "danger"
            ],
            [
                "number" => 20,
                "type" => "contact",
                "color" => "warning"
            ]
        ];

        $stats = $this->pluralize($stats);

        $lastContacts = [
            ["fullName" => "Jean Dupont", "createdAt" => new DateTime()],
            ["fullName" => "Martin Laval", "createdAt" => new DateTime()],
            ["fullName" => "René Durand", "createdAt" => new DateTime()],
            ["fullName" => "Michel Boulanger", "createdAt" => new DateTime()],
            ["fullName" => "Victor Legrand", "createdAt" => new DateTime()],
        ];

        $lastEvents = [
            ["title" => "RDV avec Jean Dupont", "date" => new DateTime()],
            ["title" => "RDV avec Martin Laval", "date" => new DateTime()],
            ["title" => "RDV avec René Durand", "date" => new DateTime()],
            ["title" => "RDV avec Michel Boulanger", "date" => new DateTime()],
            ["title" => "RDV avec Victor Legrand", "date" => new DateTime()],
        ];

        return $this->render('admin/dashboard.html.twig', [
            'title' => 'Tableau de bord',
            "stats" => $stats,
            "contacts" => $lastContacts,
            "events" => $lastEvents
        ]);
    }
}
