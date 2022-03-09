<?php

namespace App\Controller;

use DateTime;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;
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
     * 
     * @return array
     */
    public function pluralize($stats) {
        $newStats = [];

        foreach ($stats as $stat) {
            if ($stat["count"] > 1) {
                $stat["type"] .= "s";
            }

            $newStats[] = $stat;
        }

        return $newStats;
    }

    /**
     * Set card's content
     * 
     * @param EntityRepository $repository
     * @param string $type
     * @param string $link
     * @param string $color
     * 
     * @return array
     */
    public function setCard(EntityRepository $repository, string $type, string $link, string $color) {
        return [
            "count" => $repository->countAll(),
            "type" => $type,
            "link" => $link,
            "color" => $color
        ];
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        $stats = [
            $this->setCard($this->userRepository, "utilisateur", "/users", "info"),
            $this->setCard($this->teamRepository, "équipe", "/teams", "success"),
            $this->setCard($this->eventRepository, "événement", "/events", "danger"),
            $this->setCard($this->contactRepository, "contact", "/contacts", "warning")
        ];

        $stats = $this->pluralize($stats);

        $lastContacts = $this->contactRepository->findLast();

        $lastEvents = $this->eventRepository->findLast();

        return $this->render('pages/admin/dashboard.html.twig', [
            'title' => 'Tableau de bord',
            "stats" => $stats,
            "contacts" => $lastContacts,
            "events" => $lastEvents
        ]);
    }
}
