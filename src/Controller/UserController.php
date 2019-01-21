<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Repository\UserRepository;

class UserController extends AbstractController
{
    /**
     * @Route("/admin/users", name="users")
     */
    public function index(UserRepository $users): Response
    {
        return $this->render('backend/user/index.html.twig', [
            'users' => $users->findAll(),
        ]);
    }
}
