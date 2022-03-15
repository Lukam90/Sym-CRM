<?php

namespace App\Traits;

use App\Entity\User;
use App\Helpers\Constants;
use Symfony\Component\HttpFoundation\Response;

trait UserTrait
{
    /**
     * Displays an error if an user is not found
     * 
     * @param User $user
     * 
     */
    public function isNotFound(User $user) {
        if (! $user) {
            $this->addError("L'utilisateur n'a pas été trouvé.");
        }
    }

    /**
     * Checkes if a user already exists
     * 
     * @param string $email
     * 
     */
    public function alreadyExists($email) {
        return $this->repository->findByEmail($email);
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
     * Set user's register values
     * 
     * @param User $user
     */
    public function setRegisterValues(User $user) {
        $user->setFullName($this->getRequest()->get("fullName"));
        $user->setEmail($this->getRequest()->get("email"));

        $password = $this->getRequest()->get("password");
        $password = $this->encoder->hashPassword($user, $password);

        $user->setPassword($password);
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
        return $this->render('pages/users/list_users.html.twig', [
            'title' => 'Liste des utilisateurs',
            'users' => $users,
            'roles' => Constants::USER_ROLES,
            'colors' => Constants::USER_COLORS
        ]);
    }
}