<?php
/**
 * Aliment Controller
 *
 * @category Controller
 *
 * @package Aliment\Controller
 *
 * @author Vahan Barsamian <vahanbarsamian@gmail.com>
 *
 * @license free https://github.com/vahanbarsamian/SymfonyAliments
 *
 * @link https://github.com/vahanbarsamian/SymfonyAliments.tig
 *
 * PHP version 7.2.1 and above
 */
namespace App\Controller;

use App\Repository\AlimentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Aliment Controller contains methods to list and get aliments
 *
 * @category Controller
 *
 * @package Aliment\Controller
 *
 * @author Vahan Barsamian <vahanbarsamian@gmail.com>
 *
 * @license free https://github.com/vahanbarsamian/SymfonyAliments
 *
 * @link https://github.com/vahanbarsamian/SymfonyAliments.tig
 *
 * PHP version 7.2.1
 */
class AlimentController extends AbstractController
{
    /**
     * This return all aliments
     *
     * @param $repo Aliment Repository
     *
     * @return array
     *
     * @Route("/aliments", name="list_aliment")
     */
    public function listAction(AlimentRepository $repo)
    {
        $aliments = $repo->findAll();
        return $this->render(
            'aliment/list_aliment.html.twig',
            [
                'titre' => 'Liste des aliments',
                'aliments' => $aliments,
            ]
        );
    }

    /**
     * This return selected aliments less than n colories
     *
     * @param AlimentRepository $repo  design the Repository
     * @param string            $type  on what it will be filter open_with
     * @param string            $signe is the symbol comparaison
     * @param float             $value the value used to filter aliment
     *
     * @return void
     *
     * @Route("/aliments/{type}/{signe}/{value}", name="aliments-filter")
     */
    public function filterAction(AlimentRepository $repo, $type, $signe, $value)
    {
        $aliments = $repo->findByFilter($type, $signe, $value);
        return $this->render(
            'aliment/aliments_filter.html.twig',
            [
                'titre' => 'liste des aliments avec moins de ' .$value.' '.($value>1 ? $type.'s': $type),
                'aliments' => $aliments,
            ]
        );
    }
}
