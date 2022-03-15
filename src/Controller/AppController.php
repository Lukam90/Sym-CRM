<?php

namespace App\Controller;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class AppController extends AbstractController
{
    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * Get current request
     */
    public function getRequest() 
    {
        return $this->requestStack->getCurrentRequest();
    }

    /**
     * Get all entries from a repository
     */
    public function getAll() 
    {
        return $this->repository->findAll();
    }

    /**
     * Check if a form is submitted
     * 
     * @return bool
     */
    public function isFormSubmitted() 
    {
        return $this->getRequest()->get("submit");
    }

    /**
     * Check if the CSRF token is valid
     * 
     * @param string $tokenName
     * 
     * @return bool
     */
    function isTokenValid(string $tokenName) 
    {
        return $this->isCsrfTokenValid($tokenName, $this->getRequest()->get("_token"));
    }

    /**
     * Check if a form is valid
     * 
     * @param string $tokenName
     * 
     * @return bool
     */
    public function isFormValid(string $tokenName) 
    {
        return $this->isFormSubmitted() && $this->isTokenValid($tokenName);
    }

    /**
     * Display a success message
     * 
     * @param string $message
     */
    public function addSuccess(string $message) 
    {
        $this->addFlash("success", $message);
    }

    /**
     * Display an error message
     * 
     * @param string $message
     */
    public function addError(string $message = "Une erreur s'est produite...") 
    {
        $this->addFlash("danger", $message);
    }
}