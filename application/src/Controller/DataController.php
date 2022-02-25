<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class DataController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * Check if a form is valid
     * 
     * @param Request $request
     * @param string $tokenName
     * 
     * @return bool
     */
    public function isFormValid(Request $request, string $tokenName) {
        return $request->get("submit") && $this->isCsrfTokenValid($tokenName, $request->get("_token"));
    }
}