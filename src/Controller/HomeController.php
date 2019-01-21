<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\CalismaAlanlari;
use App\Repository\CalismaAlanlariRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/", name="home_")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(CalismaAlanlariRepository $calismaalanlari): Response
    {
        return $this->render('fronted/index.html.twig', [
            'calismaalanlari' => $calismaalanlari->findBy(['show_frontpage' => 1])
        ]);
    }
    
    /**
     * @Route("calisma-alanlari", name="calisma_alanlari")
     */

    public function calismaAlanlari(PaginatorInterface $paginator, CalismaAlanlariRepository $calismaalanlarirepository, Request $request): Response
    {
        $query = $calismaalanlarirepository->createQueryBuilder('p')->getQuery();

        
        $calismaalanlari = $paginator->paginate(
            $query, 
            $request->query->getInt('page', 1), 
            6
        );
        return $this->render('fronted/pages/calismaalanlari.html.twig', [
            'calismaalanlari' => $calismaalanlari
        ]);
    }

    /**
     * @Route("/{slug}", name="calisma_alanlari_show", methods={"GET"})
     */
    public function show(CalismaAlanlari $calismaAlanlari): Response
    {
        return $this->render('fronted/pages/calismaalanlarishow.html.twig', [
            'calisma_alanlari' => $calismaAlanlari,
        ]);
    }
}
