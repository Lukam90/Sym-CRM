<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Traits\ContactTrait;
use App\Controller\AppController;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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

    use ContactTrait;

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
