<?php

namespace App\Controller;

use App\Entity\User;
use App\Traits\UserTrait;
use App\Controller\AppController;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AppController
{
    /**
     * @var UserPasswordHasherInterface
     */
    private $encoder;

    /* Constructor */

    public function __construct(UserRepository $repository, EntityManagerInterface $entityManager, RequestStack $requestStack, UserPasswordHasherInterface $encoder) 
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
        $this->encoder = $encoder;
    }

    /* Utilities */

    use UserTrait;

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
    public function sort(string $column, string $order): Response 
    {
        $users = $this->repository->findSorted($column, $order);

        return $this->renderList($users);
    }

    /**
     * @Route("/users/search", name="users.search")
     * 
     * @return Response
     */
    public function search(): Response 
    {
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
        if ($this->isFormValid("register")) {
            $email = $this->getRequest()->get("email");

            if ($this->alreadyExists($email)) {
                $this->addError("Un utilisateur existe déjà avec cette adresse e-mail.");

                return $this->redirectToRoute('home');
            }

            $user = new User;

            $this->setRegisterValues($user);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->addSuccess("L'inscription s'est bien déroulée.");
        } else {
            $this->addError();
        }

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
        if ($this->isFormValid("reset")) {
            $this->addSuccess("Votre lien de réinitialisation du mot de passe a été envoyé à votre adresse e-mail.");
        } else {
            $this->addError();
        }

        return $this->redirectToRoute('home');
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
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->isFormValid("login")) {
            if ($this->getUser()) {
                $this->addFlash("success", "Connexion réussie !");

                // Get the login error if there is one

                $error = $authenticationUtils->getLastAuthenticationError();

                if ($error) {
                    $this->addError("Une erreur de connexion s'est produite.");

                    return $this->redirectToRoute('home');
                }

                // Last username / email entered by the user

                $lastUsername = $authenticationUtils->getLastUsername();

                return $this->redirectToRoute('dashboard');
            }
        }

        return $this->render('pages/home/index.html.twig');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(): Response
    {
        $this->addSuccess("La déconnexion s'est bien déroulée.");

        return $this->redirectToRoute('home');
    }
}
