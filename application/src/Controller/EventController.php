<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /**
     * @Route("/events", name="events")
     */
    public function index(): Response
    {
        return $this->render('events/calendar.html.twig', [
            'title' => 'Calendrier',
        ]);
    }

    /**
     * @Route("/events/add", name="add_event")
     */
    public function add(): Response
    {
        return $this->render('events/form_events.html.twig', [
            'title' => "Ajout d'un événement",
        ]);
    }

    /**
     * @Route("/events/edit/{id}", name="edit_event")
     */
    public function edit(): Response
    {
        return $this->render('event/index.html.twig', [
            'title' => "Edition d'un événement",
        ]);
    }

    /**
     * @Route("/events/delete/{id}", name="delete_event")
     */
    public function delete(): Response
    {
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }

    /**
     * @Route("/events/import", name="import_events")
     */
    public function import(): Response
    {
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }

    /**
     * @Route("/events/send", name="send_invitation")
     */
    public function send(): Response
    {
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }

    /**
     * @Route("/events/accept", name="accept_invitation")
     */
    public function accept(): Response
    {
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }

    /**
     * @Route("/events/decline", name="decline_invitation")
     */
    public function decline(): Response
    {
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }

    /**
     * @Route("/events/export", name="export_events")
     */
    public function export(): Response
    {
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }
}
