<?php

namespace App\Controller;

use DateTime;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use App\Repository\EventRepository;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @var 
     */
    private UserRepository $userRepository;

    /**
     * @var 
     */
    private TeamRepository $teamRepository;

    /**
     * @var 
     */
    private ContactRepository $contactRepository;

    /**
     * @var 
     */
    private EventRepository $eventRepository;

    // Constructor

    public function __construct(
        UserRepository $userRepository,
        TeamRepository $teamRepository,
        ContactRepository $contactRepository,
        EventRepository $eventRepository
    ) {
        $this->userRepository = $userRepository;
        $this->teamRepository = $teamRepository;
        $this->contactRepository = $contactRepository;
        $this->eventRepository = $eventRepository;
    }

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
                "number" => $this->userRepository->countAll(),
                "type" => "utilisateur",
                "color" => "info"
            ],
            [
                "number" => $this->teamRepository->countAll(),
                "type" => "équipe",
                "color" => "success"
            ],
            [
                "number" => $this->eventRepository->countAll(),
                "type" => "événement",
                "color" => "danger"
            ],
            [
                "number" => $this->contactRepository->countAll(),
                "type" => "contact",
                "color" => "warning"
            ]
        ];

        $stats = $this->pluralize($stats);

        $lastContacts = $this->contactRepository->findLast();

        $lastEvents = $this->eventRepository->findLast();

        return $this->render('admin/dashboard.html.twig', [
            'title' => 'Tableau de bord',
            "stats" => $stats,
            "contacts" => $lastContacts,
            "events" => $lastEvents
        ]);
    }
}
