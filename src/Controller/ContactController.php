<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Helpers\Constants;
use App\Form\ContactFormType;
use App\Controller\AppController;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

class ContactController extends AppController
{
    /* Constructor */

    public function __construct(ContactRepository $repository, EntityManagerInterface $entityManager, RequestStack $requestStack) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

    /* Utilities */

    /**
     * Displays an error if an contact is not found
     * 
     * @param Contact $contact
     * 
     */
    public function isNotFound(Contact $contact) {
        if (! $contact) {
            $this->addError("L'événement #$id n'a pas été trouvé.");
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
            "types" => Constants::TYPES,
            "roles" => Constants::ROLES
        ]);
    }

    /* CRUD */

    /**
     * @Route("/contacts", name="contacts")
     * 
     * @return Response
     */
    public function index(): Response {
        $contacts = $this->getAll();

        return $this->renderList($contacts);
    }

    /**
     * @Route("/contacts/sort/{column}/{order}", name="contacts.sort")
     * 
     * @param string $column
     * @param string $order
     * 
     * @return Response
     */
    public function sort(string $column, string $order): Response {
        $contacts = $this->repository->findSorted($column, $order);

        return $this->renderList($contacts);
    }

    /**
     * @Route("/contacts/search", name="contacts.search")
     * 
     * @return Response
     */
    public function search(): Response {
        $name = $this->getRequest()->get("filter");

        $contacts = $this->repository->findByName($name);

        return $this->renderList($contacts);
    }

    /**
     * @Route("/contacts/new", name="contacts.new")
     * 
     * @return Response
     */
    public function new(): Response
    {
        if ($this->isFormValid("new")) {
            $contact = new Contact;
            
            $this->setFormValues($contact);

            $this->entityManager->persist($contact);
            $this->entityManager->flush();

            $this->addSuccess("Le contact a bien été ajouté.");
        } else {
            $this->addError();
        }

        return $this->redirectToRoute("contacts");
    }

    /**
     * @Route("/contacts/edit/{id}", name="contacts.edit")
     * 
     * @param $id
     * 
     * @return Response
     */
    public function edit($id): Response {
        $contact = $this->getContact($id);

        $this->isNotFound($contact);

        if ($this->isFormValid("edit")) {
            $this->setFormValues($contact);

            $this->entityManager->flush();

            $this->addSuccess("Le contact a bien été édité.");
        } else {
            $this->addError();
        }

        return $this->redirectToRoute("contacts");
    }

    /**
     * @Route("/contacts/delete/{id}", name="contacts.delete")
     * 
     * @param $id
     * 
     * @return Response
     */
    public function delete($id): Response
    {
        $contact = $this->getContact($id);

        $this->isNotFound($contact);

        if ($this->isTokenValid("delete")) {
            $this->entityManager->remove($contact);
            $this->entityManager->flush();

            $this->addSuccess("Le contact a bien été supprimé.");
        } else {
            $this->addError();
        }

        return $this->redirectToRoute("contacts");
    }
}