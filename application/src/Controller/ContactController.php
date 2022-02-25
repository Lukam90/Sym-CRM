<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Controller\DataController;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends DataController
{
    /**
     * @var ContactRepository
     */
    private $repository;

    public function __construct(ContactRepository $repository, EntityManagerInterface $entityManager) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/contacts", name="contacts")
     * 
     * @return Response
     */
    public function index(): Response {
        $contacts = $this->repository->findAll();

        return $this->render('contacts/list_contacts.html.twig', [
            'title' => 'Liste des contacts',
            "contacts" => $contacts
        ]);
    }

    /**
     * @Route("/contacts/new", name="contacts.new")
     */
    public function new(Request $request): Response
    {
        $contact = new Contact;

        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($contact);
            $this->entityManager->flush();

            $this->addFlash("success", "Contact ajouté avec succès.");

            return $this->redirectToRoute("contacts");
        }

        return $this->render('contacts/form_contacts.html.twig', [
            'title' => "Ajout d'un contact",
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/contacts/edit/{id}", name="contacts.edit")
     * 
     * @param Contact $contact
     * @param Request $request
     * 
     * @return Response
     */
    public function edit(Contact $contact, Request $request): Response {
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            $this->addFlash("success", "Contact édité avec succès.");

            return $this->redirectToRoute("contacts");
        }

        return $this->render('contacts/form_contacts.html.twig', [
            'title' => "Edition d'un contact",
            "contact" => $contact,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/contacts/delete/{id}", name="contacts.delete")
     * 
     * @param Contact $contact
     * 
     * @return RedirectResponse
     */
    public function delete(Contact $contact, Request $request): Response
    {
        if ($this->isCsrfTokenValid("delete" . $contact->getId(), $request->get("_token"))) {
            $this->entityManager->remove($contact);
            $this->entityManager->flush();

            $this->addFlash('success', "Le contact a bien été supprimé !");
        }

        return $this->redirectToRoute("contacts");
    }
}
