<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/_error")
 */
class ErrorController extends AbstractController
{
    /**
     * @Route("/403", name="not_authorized")
     */
    public function forbidden(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error403.html.twig', []);
    }

    /**
     * @Route("/404", name="not_found")
     */
    public function notFound(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error404.html.twig', []);
    }
}