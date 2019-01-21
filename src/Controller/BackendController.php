<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin")
 */
class BackendController extends AbstractController
{
    /**
     * @Route("/", name="admin_index")
     */
    public function index()
    {
        return $this->render('backend/index.html.twig', [
            'controller_name' => 'BackendController',
        ]);
    }
}
