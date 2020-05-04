<?php

namespace App\Controller\Admin;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function listAction(AlimentRepository $repo)
    {
        $aliments = $repo->findAll();
        return $this->render(
            'admin/admin/dashboard.html.twig',
            [
                'titre' => 'Dashboard Aliments',
                'aliments' => $aliments,
            ]
        );
    }

    /**
     * Add a new aliment
     *
     * @param Aliment                $aliment represent an aliment
     * @param Request                $request request of submit
     * @param EntityManagerInterface $manager manager to update database
     *
     * @return an aliment empty form / new aliment
     *
     * @Route("/aliment/create", name="add_aliment")
     */
    public function addAction(
        Aliment $aliment = null,
        Request $request,
        EntityManagerInterface $manager
    ) {

        if (!$aliment) {
            $aliment = new Aliment();
        }
        $form = $this->createForm(AlimentType::class, $aliment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($aliment);
            $manager->flush();
            $this->addFlash(
            	'success',
            	'L\'ajout d\'un aliment a bien été effectué'
            );
            return $this->redirectToRoute("admin");
        }
        return $this->render(
            'admin/admin/add_aliment.html.twig',
            [
                'titre' => 'Ajout d\'un aliment : ',
                'aliment' => $aliment,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Modify an aliment designed by its id
     *
     * @param Aliment                $aliment represent an aliment
     * @param Request                $request request of submit
     * @param EntityManagerInterface $manager manager to update database
     *
     * @return an object
     *
     * @Route("/aliment/{id}", name="modify_aliment", methods={"GET|POST"})
     */
    public function modifyAction(
        Aliment $aliment,
        Request $request,
        EntityManagerInterface $manager
    ) {
        //$manager = $this->getDoctrine()->getManager();
        $form = $this->createForm(AlimentType::class, $aliment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($aliment);
            $manager->flush();
            $this->addFlash(
                'success',
                'La modification a bien été effectuée'
            );
            return $this->redirectToRoute("admin");
        }
        return $this->render(
            'admin/admin/modify_aliment.html.twig',
            [
                'titre' => 'Modification de l\'aliment : ' . $aliment->getNom(),
                'aliment' => $aliment,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Delete an aliment designed by its id
     *
     * @param Aliment                $aliment represent an aliment
     * @param Request                $request request of submit
     * @param EntityManagerInterface $manager manager to update database
     *
     * @return void
     *
     * @Route("/aliment/{id}", name="remove_aliment", methods={"DELETE"})
     */
    public function deleteAction(
        Aliment $aliment,
        Request $request,
        EntityManagerInterface $manager
    ) {
        if ($this->isCsrfTokenValid(
            'DELETE' . $aliment->getId(),
            $request->get('_token')
        )
        ) {
            $manager->remove($aliment);
            $manager->flush();
            $this->addFlash(
                'success',
                'La suppression a bien été effectuée'
            );
            return $this->redirectToRoute('admin');
        }
    }

}
