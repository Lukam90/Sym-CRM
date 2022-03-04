<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use App\Helpers\Constants;
use App\Controller\AppController;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;

class UserController extends AppController
{
    /* Constructor */

    public function __construct(UserRepository $repository, EntityManagerInterface $entityManager, RequestStack $requestStack) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

    /* Utilities */

    /**
     * Displays an error if an user is not found
     * 
     * @param User $user
     * 
     */
    public function isNotFound(User $user) {
        if (! $user) {
            $this->addError("L'utilisateur #$id n'a pas été trouvé.");
        }
    }

    /**
     * Get an user with an ID
     * 
     * @param $id
     * 
     * @return User
     */
    public function findUser($id) {
        return $this->repository->find((int) $id);
    }

    /**
     * Set user's role
     * 
     * @param User $user
     */
    public function setRole(User $user) {
        $user->setRole($this->getRequest()->get("role"));
    }

    /**
     * Render the list of users
     * 
     * @param User[] $users
     * 
     * @return Response
     */
    public function renderList($users) : Response
    {
        return $this->render('users/list_users.html.twig', [
            'title' => 'Liste des utilisateurs',
            'users' => $users,
            'roles' => Constants::ROLES,
            'colors' => Constants::COLORS
        ]);
    }

    /* CRUD */

    /**
     * @Route("/users", name="users")
     * 
     * @return Response
     */
    public function index(): Response
    {
        $users = $this->getAll();

        return $this->renderList($users);
    }

    /**
     * @Route("/users/sort/{column}/{order}", name="users.sort")
     * 
     * @param string $column
     * @param string $order
     * 
     * @return Response
     */
    public function sort(string $column, string $order): Response {
        $users = $this->repository->findSorted($column, $order);

        return $this->renderList($users);
    }

    /**
     * @Route("/users/search", name="users.search")
     * 
     * @return Response
     */
    public function search(): Response {
        $name = $this->getRequest()->get("filter");

        $users = $this->repository->findByName($name);

        return $this->renderList($users);
    }

    /**
     * @Route("/register", name="register")
     * 
     * @return Response
     */
    public function register(): Response
    {
        return $this->redirectToRoute('home');
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
     * @param $id
     * 
     * @return Response
     */
    public function edit($id): Response
    {
        $user = $this->findUser($id);

        $this->isNotFound($user);

        if ($this->isFormValid("edit")) {
            $this->setRole($user);

            $this->entityManager->flush();

            $this->addSuccess("L'utilisateur a bien été édité.");
        } else {
            $this->addError();
        }

        return $this->redirectToRoute("users");
    }

    /**
     * @Route("/users/delete/{id}", name="users.delete")
     * 
     * @param $id
     * 
     * @return Response
     */
    public function delete($id): Response
    {
        $user = $this->findUser($id);

        $this->isNotFound($user);

        if ($this->isTokenValid("delete")) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();

            $this->addSuccess("L'utilisateur a bien été supprimé.");
        } else {
            $this->addError();
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
