<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminSecurController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordEncoderInterface $encode
    ) {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(InscriptionType::class, $utilisateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $passwordCrypt = $encode->encodePassword(
                $utilisateur,
                $utilisateur->getPassword()
            );
            $utilisateur->setPassword($passwordCrypt);
            $manager->persist($utilisateur);
            $manager->flush();
            return $this->redirectToRoute('list_aliment');
        }
        return $this->render(
            'admin_secur/inscription.html.twig',
            [
                'titre' => 'Page d\'inscription',
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Login method
     *
     * @return void
     *
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $util)
    {
        return $this->render(
            "admin_secur/login.html.twig",
            [
                'titre' => 'Page de connexion',
                'lastUsername' => $util->getLastUsername(),
                'error' => $util->getLastAuthenticationError()
            ]
        );
    }

    /**
     * Undocumented function
     *
     * @return void
     *
     * @Route("/unlog", name="unlog")
     */
    public function unlog()
    {

    }
}
