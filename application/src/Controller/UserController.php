<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index(): Response
    {
        return $this->render('users/list_users.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(): Response
    {
        return $this->render('users/register.html.twig', [
            'title' => 'Inscription',
        ]);
    }

    /**
     * @Route("/users/profile/{id}", name="profile")
     */
    public function profile(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/users/edit/{id}", name="edit_user")
     */
    public function edit(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/users/delete/{id}", name="delete_user")
     */
    public function delete(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
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
