<?php

namespace App\Traits;

use App\Entity\Contact;
use App\Helpers\Constants;

use Symfony\Component\HttpFoundation\Response;

trait ContactTrait
{
    /**
     * Displays an error if an contact is not found
     * 
     * @param Contact $contact
     * 
     */
    public function isNotFound(Contact $contact) {
        if (! $contact) {
            $this->addError("L'événement n'a pas été trouvé.");
        }
    }

    /**
     * Get an contact with an ID
     * 
     * @param $id
     * 
     * @return Contact
     */
    public function getContact($id) {
        return $this->repository->find((int) $id);
    }

    /**
     * Set form value
     * 
     * @param Contact $contact
     */
    public function setFormValues(Contact $contact) {
        $contact->setFullName($this->getRequest()->get("name"));
        $contact->setType($this->getRequest()->get("type"));
        $contact->setRole($this->getRequest()->get("role"));
        $contact->setAddress($this->getRequest()->get("address"));
        $contact->setPhone($this->getRequest()->get("phone"));
        $contact->setEmail($this->getRequest()->get("email"));
        $contact->setWebsite($this->getRequest()->get("website"));
    }

    /**
     * Render the list of contacts
     * 
     * @param Contact[] $contacts
     * 
     * @return Response
     */
    public function renderList($contacts) : Response
    {
        return $this->render('pages/contacts/list_contacts.html.twig', [
            "title" => "Liste des contacts",
            "contacts" => $contacts,
            "types" => Constants::CONTACT_TYPES,
            "roles" => Constants::CONTACT_ROLES
        ]);
    }
}