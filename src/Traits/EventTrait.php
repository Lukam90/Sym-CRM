<?php

namespace App\Traits;

use DateTime;
use App\Entity\Event;
use App\Helpers\Constants;
use Symfony\Component\HttpFoundation\Response;

trait EventTrait
{
    /**
     * Displays an error if an event is not found
     * 
     * @param Event $event
     * 
     */
    public function isNotFound(Event $event) 
    {
        if (! $event) {
            $this->addError("L'événement n'a pas été trouvé.");
        }
    }

    /**
     * Get an event with an ID
     * 
     * @param $id
     * 
     * @return Event
     */
    public function getEvent($id) 
    {
        return $this->repository->find((int) $id);
    }

    /**
     * Set form values
     * 
     * @param Event $event
     */
    public function setFormValues(Event $event)
    {
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
        return $this->render('pages/events/list_events.html.twig', [
            'title' => 'Liste des événements',
            'events' => $events,
            'types' => Constants::EVENT_TYPES,
        ]);
    }
}