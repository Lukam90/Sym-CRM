<?php

namespace App\Controller;

use DateTime;
use App\Entity\Event;
use App\Traits\EventTrait;
use App\Controller\AppController;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;

class EventController extends AppController
{
    /* Constructor */

    public function __construct(EventRepository $repository, EntityManagerInterface $entityManager, RequestStack $requestStack) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

    /* Utilities */

    use EventTrait;

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
     * @Route("/events/sort/{column}/{order}", name="events.sort")
     * 
     * @param string $column
     * @param string $order
     * 
     * @return Response
     */
    public function sort(string $column, string $order): Response {
        $events = $this->repository->findSorted($column, $order);

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

        return $this->render('pages/events/calendar.html.twig', [
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
