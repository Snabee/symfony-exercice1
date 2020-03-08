<?php

namespace App\Controller;

use App\Entity\Taches;
use App\Form\TacheType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TachesController extends AbstractController
{
    /**
     * @Route("/taches", name="taches")
     */
    public function index(EntityManagerInterface $entityManager, Request $request)
    {

        $taches = new taches();
        $form = $this->createForm(TacheType::class, $taches);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()){
            $taches = $form->getData();

            $entityManager->persist($taches);
            $entityManager->flush();

            return $this->redirectToRoute('taches');
        }
        
        $taches = $this->getDoctrine()
        ->getRepository(Taches::class)
        ->findAll();

        return $this->render('taches/index.html.twig', [
            'taches' => $taches,
            'TacheForm' => $form->createView()
        ]);
    }
}
