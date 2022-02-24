<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EventFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(UserRepository $repository, EntityManagerInterface $entityManager) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/users", name="users")
     * 
     * @return Response
     */
    public function index(): Response
    {
        $users = $this->repository->findAll();

        return $this->render('users/list_users.html.twig', [
            'title' => 'Liste des utilisateurs',
            'users' => $users
        ]);
    }

    /**
     * @Route("/register", name="register")
     * 
     * @return Response
     */
    public function register(): Response
    {
        return $this->render('users/register.html.twig', [
            'title' => 'Inscription',
        ]);
    }

    /**
     * @Route("/users/show/{id}", name="users.show")
     * 
     * @return Response
     */
    public function show($id): Response
    {
        $user = $this->repository->find($id);

        return $this->render('users/profile.html.twig', [
            'title' => 'Calendrier',
            'user' => $user
        ]);
    }

    /**
     * @Route("/users/edit/{id}", name="users.edit")
     * 
     * @param User $user
     * @param Request $request
     * 
     * @return Response
     */
    public function edit(User $user, Request $request): Response
    {
        $form = $this->createForm(EventFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            $this->addFlash("success", "Utilisateur édité avec succès.");

            return $this->redirectToRoute("users");
        }

        return $this->render('users/form_profile.html.twig', [
            'title' => "Profil de l'utilisateur",
            "user" => $user,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/users/delete/{id}", name="users.delete")
     * 
     * @param User $user
     * @param Request $request
     * 
     * @return Response
     */
    public function delete(User $user, Request $request): Response
    {
        if ($this->isCsrfTokenValid("delete" . $user->getId(), $request->get("_token"))) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();

            $this->addFlash('success', "L'utilisateur a bien été supprimé !");
        }

        return $this->redirectToRoute("users");
    }

    /**
     * @Route("/reset", name="reset_password")
     */
    public function reset(): Response
    {
        return $this->render('users/reset.html.twig', [
            'title' => 'Réinitialisation du mot de passe',
        ]);
    }

    /**
     * @Route("/new_password", name="new_password")
     */
    public function new_password(): Response
    {
        return $this->render('users/new_password.html.twig', [
            'title' => 'Demande de nouveau mot de passe',
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(): Response
    {
        return $this->redirectToRoute('home');
    }
}
