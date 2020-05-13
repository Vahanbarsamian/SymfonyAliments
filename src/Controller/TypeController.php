<?php

namespace App\Controller;

use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TypeController extends AbstractController
{
    /**
     * @Route("/types", name="list_type")
     */
    public function listAction(TypeRepository $repo)
    {
        $types = $repo->findAll();
        return $this->render(
            'type/list_type.html.twig',
            [
                'titre' => 'Liste des types d\'aliments',
                'types' => $types,
            ]
        );
    }
}
