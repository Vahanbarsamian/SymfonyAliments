<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Form\TypeFormType;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TypeController extends AbstractController
{
    /**
     * @Route("/admin/types", name="admin_list_type")
     */
    public function listAction(TypeRepository $repo)
    {
        $types = $repo->findAll();
        return $this->render(
            'admin/type/dashboard.html.twig',
            [
                'titre' => 'Dashboard des Types',
                'types' => $types,
            ]
        );
    }

    /**
     * Undocumented function
     *
     * @param Type $type
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return void
     *
     * @Route("/admin/type/create", name="admin_add_type")
     */
    public function addAction(
        Request $request,
        EntityManagerInterface $manager,
        Type $type = null
    ) {
        if ($type == null) {
            $type = new Type();
        }
        $form = $this->createForm(TypeFormType::class, $type);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($type);
            $manager->flush();
            $this->addFlash(
                'success',
                'Le nouveau type d\'aliment à bien été créé'
            );
            return $this->redirectToRoute('admin_list_type');
        }
        return $this->render(
            '/admin/type/add.html.twig',
            [
                'titre' => "Ajout d'un nouveau type d'aliment",
                'form' => $form->createView(),
            ]
        );
    }

    /**
     *
     * @param Type $type
     * @param Request $request
     * @param EntityManagerInterface $manager
     *
     * @return void
     *
     * @Route("/admin/type/{id}", name="admin_modify_type", methods={"GET|POST"})
     */
    public function modifyAction(
        Type $type,
        Request $request,
        EntityManagerInterface $manager
    ) {
        $form = $this->createForm(TypeFormType::class, $type);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($type);
            $manager->flush();
            $this->addFlash(
                'success',
                'La modification de ' . $type->getLibelle() . ' à bien été effectuée'
            );
            return $this->redirectToRoute('admin_list_type');
        }
        return $this->render(
            'admin/type/modify.html.twig',
            [
                'titre' => 'Modifications du type ' . $type->getLibelle(),
                'type' => $type,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Undocumented function
     *
     * @param Type $type
     * 
     * @return void
     *
     * @Route("/admin/type/{id}", name="admin_remove_type", methods={"DELETE"})
     */
    public function removeAction(
        Type $type,
        Request $request,
        EntityManagerInterface $manager
    ) {
        if ($this->isCsrfTokenValid(
            "DELETE" . $type->getId(),
            $request->get("_token")
        )
        ) {
            $manager->remove($type);
            $manager->flush();
            $this->addFlash("success", "L'enregistrment à bien été supprimé");
            return $this->redirectToRoute('admin_list_type');
        }

    }
}
