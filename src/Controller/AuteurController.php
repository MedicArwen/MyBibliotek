<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Auteur;
use App\Service\LivreService;
use App\Form\AuteurType;
use App\Service\AuteurService;

class AuteurController extends AbstractController
{
    /**
     * @Route("/auteur", name="auteur")
     */
    public function index(): Response
    {
        return $this->render('auteur/index.html.twig', [
            'controller_name' => 'AuteurController',
        ]);
    }
    /**
     * @Route("/auteur/create",name="auteur_create")
     */
    public function new(Request $request,AuteurService $auteurService):Response
    {
        $auteur = new Auteur();
        $form = $this->createForm(AuteurType::class,$auteur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            //enregistrer le lauteur
            $auteurService->create($form->getData());
            return $this->redirectToRoute('auteur_list');
        }

        return $this->render('auteur/create.html.twig', ['formulaire'=>$form->createView()
        ]);
    }
    /**
     * @Route("auteur/list",name="auteur_list")
     */
    public function list(AuteurService $auteurService):Response
    {
        return $this->render('auteur/list.html.twig', 
            ['auteurs'=>$auteurService->list()]);
       
    }
}
