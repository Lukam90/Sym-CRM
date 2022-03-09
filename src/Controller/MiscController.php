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
    public function renderKanban(): Response
    {
        return $this->render('pages/misc/kanban.html.twig');
    }

    /**
     * @Route("/gantt", name="gantt")
     */
    public function renderGantt(): Response
    {
        return $this->render('pages/misc/gantt.html.twig');
    }
}
