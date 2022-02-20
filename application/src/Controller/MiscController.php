<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MiscController extends AbstractController
{
    /**
     * @Route("/kanban", name="kanban")
     */
    public function kanban(): Response
    {
        return $this->render('misc/kanban.html.twig');
    }
}
