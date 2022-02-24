<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventFormType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EventController extends AbstractController
{
    /**
     * @var EventRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EventRepository $repository, EntityManagerInterface $entityManager) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
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
            'title' => 'Calendrier',
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
        $event = $this->repository->find($id);

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
        $event = new Event;

        $form = $this->createForm(EventFormType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($event);
            $this->entityManager->flush();

            $this->addFlash("success", "Evénement ajouté avec succès");

            return $this->redirectToRoute("events");
        }

        return $this->render('events/form_events.html.twig', [
            'title' => "Ajout d'un événement",
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/events/edit/{id}", name="events.edit")
     * 
     * @param Event $event
     * @param Request $request
     * 
     * @return Response
     */
    public function edit(Event $event, Request $request): Response
    {
        $form = $this->createForm(EventFormType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            $this->addFlash("success", "Evénement édité avec succès.");

            return $this->redirectToRoute("events");
        }

        return $this->render('events/form_events.html.twig', [
            'title' => "Edition d'un événement",
            "event" => $event,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/events/delete/{id}", name="events.delete")
     * 
     * @param Event $event
     * @param Request $request
     * 
     * @return Response
     */
    public function delete(Event $event, Request $request): Response
    {
        if ($this->isCsrfTokenValid("delete" . $event->getId(), $request->get("_token"))) {
            $this->entityManager->remove($event);
            $this->entityManager->flush();

            $this->addFlash('success', "L'événement a bien été supprimé !");
        }

        return $this->redirectToRoute("events");
    }

    /**
     * @Route("/events/send", name="events.send")
     */
    public function send(): Response
    {
        return $this->render('event/calendar.twig');
    }

    /**
     * @Route("/events/accept", name="events.accept")
     */
    public function accept(): Response
    {
        return $this->render('event/calendar.twig');
    }

    /**
     * @Route("/events/decline", name="events.decline")
     */
    public function decline(): Response
    {
        return $this->render('event/calendar.twig');
    }
}
