<?php

namespace App\Controller;

use DateTime;
use App\Entity\Event;
use App\Form\EventFormType;
use App\Controller\AppController;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

class EventController extends AppController
{
    /* Constants */

    const TYPES = [
        ["id" => "reunion", "value" => "Réunion"],
        ["id" => "tache", "value" => "Tâche"],
    ];

    /* Constructor */

    public function __construct(EventRepository $repository, EntityManagerInterface $entityManager, RequestStack $requestStack) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

    /**
     * Displays an error if an event is not found
     * 
     * @param Event $event
     * 
     */
    public function isNotFound(Event $event) {
        if (! $event) {
            $this->addError("L'événement #$id n'a pas été trouvé.");
        }
    }

    /**
     * Get an event with an ID
     * 
     * @param $id
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
     */
    public function setFormValues(Event $event) {
        $event->setTitle($this->getRequest()->get("title"));
        $event->setType($this->getRequest()->get("type"));
        $event->setDate(new DateTime($this->getRequest()->get("date")));
        $event->setDescription($this->getRequest()->get("description"));
    }

    /**
     * Render the list of events
     * 
     * @param Event[] $events
     * 
     * @return Response
     */
    public function renderList($events) : Response
    {
        return $this->render('events/list_events.html.twig', [
            'title' => 'Liste des événements',
            'events' => $events,
            'types' => self::TYPES,
        ]);
    }

    /* CRUD */
    
    /**
     * @Route("/events", name="events")
     * 
     * @return Response
     */
    public function index(): Response
    {
        $events = $this->getAll();

        return $this->renderList($events);
    }

    /**
     * @Route("/events/sort/{column}", name="events.sort")
     * 
     * @param string $column
     * 
     * @return Response
     */
    public function sort(string $column): Response {
        $events = $this->repository->findSorted($column);

        return $this->renderList($events);
    }

    /**
     * @Route("/events/search", name="events.search")
     * 
     * @return Response
     */
    public function search(): Response {
        $title = $this->getRequest()->get("filter");

        $events = $this->repository->findByTitle($title);

        return $this->renderList($events);
    }

    /**
     * @Route("/events/show/{id}", name="events.show")
     * 
     * @param $id
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
     * @return Response
     */
    public function new(): Response
    {
        if ($this->isFormValid("new")) {
            $event = new Event;

            $this->setFormValues($event);

            $this->entityManager->persist($event);
            $this->entityManager->flush();

            $this->addSuccess("L'événement a bien été ajouté.");
        } else {
            $this->addError();
        }

        return $this->redirectToRoute("events");
    }

    /**
     * @Route("/events/edit/{id}", name="events.edit")
     * 
     * @param $id
     * 
     * @return Response
     */
    public function edit($id): Response
    {
        $event = $this->getEvent($id);

        $this->isNotFound($event);

        if ($this->isFormValid("edit")) {
            $this->setFormValues($event);

            $this->entityManager->flush();

            $this->addSuccess("L'événement a bien été édité.");
        } else {
            $this->addError();
        }

        return $this->redirectToRoute("events");
    }

    /**
     * @Route("/events/delete/{id}", name="events.delete")
     * 
     * @param $id
     * 
     * @return Response
     */
    public function delete($id): Response
    {
        $event = $this->getEvent($id);

        $this->isNotFound($event);

        if ($this->isTokenValid("delete")) {
            $this->entityManager->remove($event);
            $this->entityManager->flush();

            $this->addSuccess("L'événement a bien été supprimé.");
        } else {
            $this->addError();
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
