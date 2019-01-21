<?php

namespace App\Controller;

use App\Entity\CalismaAlanlari;
use App\Form\CalismaAlanlariType;
use App\Repository\CalismaAlanlariRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Filesystem\Filesystem;
use Gedmo\Mapping\Annotation\Slug;

/**
 * @Route("admin/calisma/alanlari")
 */
class CalismaAlanlariController extends AbstractController
{
    /**
     * Fields to be shown on lists
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('__toString');
    }

    /**
     * @Route("/", name="calisma_alanlari_index", methods={"GET"})
     */
    public function index(CalismaAlanlariRepository $calismaAlanlariRepository): Response
    {
        return $this->render('backend/calisma_alanlari/index.html.twig', [
            'calisma_alanlaris' => $calismaAlanlariRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="calisma_alanlari_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $calismaAlanlari = new CalismaAlanlari();
        $form = $this->createForm(CalismaAlanlariType::class, $calismaAlanlari);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if( !empty( $calismaAlanlari->getImage() ) )
            {
                /** @var UploadedFile $file */
                $file = $calismaAlanlari->getImage();
                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
                
                try {
                    $file->move(
                        $this->getParameter('images_dir'),
                        $fileName
                    );
                }catch ( FileExeption $e ){
                    return new Response('HATA: Dosya yüklenmesinde bir hata oluştu.');
                }
                $calismaAlanlari->setImage($fileName);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($calismaAlanlari);
                $entityManager->flush();

                return $this->redirectToRoute('calisma_alanlari_show', ['slug' => $calismaAlanlari->getSlug()]);
            }else {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($calismaAlanlari);
                $entityManager->flush();

                return $this->redirectToRoute('calisma_alanlari_show', ['slug' => $calismaAlanlari->getSlug()]);
            }
            
            
        }

        return $this->render('backend/calisma_alanlari/new.html.twig', [
            'calisma_alanlari' => $calismaAlanlari,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="calisma_alanlari_show", methods={"GET"})
     */
    public function show(CalismaAlanlari $calismaAlanlari): Response
    {
        $show_frontpage = $calismaAlanlari->getShowFrontpage();
        
        return $this->render('backend/calisma_alanlari/show.html.twig', [
            'calisma_alanlari' => $calismaAlanlari,
            'show_frontpage' => $show_frontpage,
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="calisma_alanlari_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CalismaAlanlari $calismaAlanlari): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        
        $calismaAlanlari->setImage(
                    new File($this->getParameter('images_dir').'/'.$calismaAlanlari->getImage())
                    );
        $image = $calismaAlanlari->getImage()->getFilename();

        $form = $this->createForm(CalismaAlanlariType::class, $calismaAlanlari);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {


            if( !empty( $calismaAlanlari->getImage() ) )
            {
                $fileSystem = new FileSystem();
                
                $fileSystem->remove([$this->getParameter('images_dir').'/'.$image]);
                
                /** @var UploadedFile $file */
                $file = $calismaAlanlari->getImage();
                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
                
                try {

                    $file->move(
                        $this->getParameter('images_dir'),
                        $fileName
                    );
                }catch ( FileExeption $e ){
                    return new Response('HATA: Dosya yüklenmesinde bir hata oluştu.');
                }
                
                
                $calismaAlanlari->setImage($fileName);                
                $entityManager->persist($calismaAlanlari);
                $entityManager->flush();

                return $this->redirectToRoute('calisma_alanlari_show', ['slug' => $calismaAlanlari->getSlug()]);
            }else {
                $calismaAlanlari->setImage($image);
                $entityManager->persist($calismaAlanlari);
                $entityManager->flush();

                return $this->redirectToRoute('calisma_alanlari_show', ['slug' => $calismaAlanlari->getSlug()]);

            }
        }
        return $this->render('backend/calisma_alanlari/edit.html.twig', [
            'calisma_alanlari' => $calismaAlanlari,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="calisma_alanlari_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CalismaAlanlari $calismaAlanlari): Response
    {
        $fileSystem = new FileSystem();

        if ($this->isCsrfTokenValid('delete'.$calismaAlanlari->getId(), $request->request->get('_token'))) {
            $fileName = $calismaAlanlari->getImage();
            $delete = $fileSystem->remove([$this->getParameter('images_dir').'/'.$fileName]);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($calismaAlanlari);
            $entityManager->flush();
        }

        return $this->redirectToRoute('calisma_alanlari_index');
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }


}
