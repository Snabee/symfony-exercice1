<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\IdentificationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $entityManager, Request $request)
    {

        $users = new users();
        $form = $this->createForm(IdentificationType::class, $users);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()){
            $users = $form->getData();

            $entityManager->persist($users);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }
        
        $users = $this->getDoctrine()
        ->getRepository(Users::class)
        ->findAll();

        return $this->render('users/index.html.twig', [
            'users' => $users,
            'IdentificationForm' => $form->createView()
        ]);
    }
    
    
}
