<?php

namespace App\Controller;

use DateTime;
use App\Entity\Event;
use App\Form\EventFormType;
use App\Controller\DataController;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends DataController
{
    /**
     * @var EventRepository
     */
    private $repository;

    public function __construct(EventRepository $repository, EntityManagerInterface $entityManager) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * Displays an error if an event is not found
     * 
     * @param Event $event
     * 
     */
    public function isNotFound(Event $event) {
        if (! $event) {
            $this->addFlash("danger", "L'événement #$id n'a pas été trouvé.");
        }
    }

    /**
     * @param $id
     * 
     * Get an event with an ID
     * 
     * @return Event
     */
    public function getEvent($id) {
        return $this->repository->find((int) $id);
    }

    /**
     * Set form values
     * 
     * @param Event $event
     * @param Request $request
     */
    public function setValues(Event $event, Request $request) {
        $event->setTitle($request->get("title"));
        $event->setType($request->get("type"));
        $event->setDate(new DateTime($request->get("date")));
        $event->setDescription($request->get("description"));
    }
    
    /**
     * @Route("/events", name="events")
     * 
     * @return Response
     */
    public function index(): Response
    {
        $events = $this->repository->findAll();

        return $this->render('events/list_events.html.twig', [
            'title' => 'Liste des événements',
            'events' => $events
        ]);
    }

    /**
     * @Route("/events/show/{id}", name="events.show")
     * 
     * @return Response
     */
    public function show($id): Response
    {
        $event = $this->getEvent($id);

        $this->isNotFound($event);

        return $this->render('events/calendar.html.twig', [
            'title' => 'Calendrier',
            'event' => $event
        ]);
    }

    /**
     * @Route("/events/new", name="events.new")
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function new(Request $request): Response
    {
        if ($this->isFormValid("new")) {
            $event = new Event;

            $this->setValues();

            $this->entityManager->persist($event);
            $this->entityManager->flush();

            $this->addFlash("success", "L'événement a bien été ajouté.");
        }

        return $this->redirectToRoute("events");
    }

    /**
     * @Route("/events/edit/{id}", name="events.edit")
     * 
     * @param Event $event
     * @param Request $request
     * 
     * @return Response
     */
    public function edit($id, Request $request): Response
    {
        $event = $this->getEvent($id);

        $this->isNotFound($event);

        if ($this->isFormValid("edit")) {
            $this->setValues();

            $this->entityManager->flush();

            $this->addFlash("success", "L'événement a bien été édité.");
        }

        return $this->redirectToRoute("events");
    }

    /**
     * @Route("/events/delete/{id}", name="events.delete")
     * 
     * @param Event $event
     * @param Request $request
     * 
     * @return Response
     */
    public function delete($id, Request $request): Response
    {
        $event = $this->getEvent($id);

        $this->isNotFound($event);

        if ($this->isFormValid("delete")) {
            $this->entityManager->remove($event);
            $this->entityManager->flush();

            $this->addFlash('success', "L'événement a bien été supprimé.");
        }

        return $this->redirectToRoute("events");
    }

    /**
     * @Route("/events/send", name="events.send")
     */
    public function send(): Response
    {
        return $this->render('events/calendar.twig');
    }

    /**
     * @Route("/events/accept", name="events.accept")
     */
    public function accept(): Response
    {
        return $this->render('events/calendar.twig');
    }

    /**
     * @Route("/events/decline", name="events.decline")
     */
    public function decline(): Response
    {
        return $this->render('events/calendar.twig');
    }
}
