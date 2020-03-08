<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\IdentificationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UsersInfosController extends AbstractController
{
    /**
     * @Route("/users/infos", name="users_infos")
     */
    public function index(EntityManagerInterface $entityManager, Request $request)
    {

        $id = $_GET['id'];
        $nom = $_GET['nom'];
        $prenom = $_GET['prenom'];

        $users = new users();
        $form = $this->createForm(IdentificationType::class, $users);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $users = $form->getData();

            $entityManager->persist($users);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        $users = $this->getDoctrine()->getRepository(Users::class);

        $theUser = $users->findOneBy(['id' => $id]);

        return $this->render('users_infos/index.html.twig', [
            'controller_name' => 'UsersInfosController',
            'IdentificationForm' => $form->createView(),
            'id' => $id,
            'users' => $users,
            'nom' => $nom,
            'prenom' => $prenom
        ]);
    }
}
