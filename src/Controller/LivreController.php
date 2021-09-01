<?php

namespace App\Controller;

use App\Form\LivreType;
use App\Entity\Livre;
use App\Service\LivreService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LivreController extends AbstractController
{
    /**
     * @Route("/livre", name="livre")
     */
    public function index(): Response
    {
        return $this->render('livre/index.html.twig', [
            'controller_name' => 'LivreController',
        ]);
    }
    /**
     * @Route("livre/create",name="livre_create")
     */
    public function new(Request $request , LivreService $livreService)
    {
        $livre= new Livre();
        $form = $this->createForm(LivreType::class,$livre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            //enregistrer le livre
            $livreService->create($form->getData());
            return $this->redirectToRoute('livre_list');
        }

        return $this->render('livre/create.html.twig', ['formulaire'=>$form->createView()
        ]);
    }
     /**
     * @Route("livre/list",name="livre_list")
     */
    public function list(LivreService
     $livreService):Response
    {
        return $this->render('livre/list.html.twig', 
            ['livres'=>$livreService->list()]);
       
    }
}
