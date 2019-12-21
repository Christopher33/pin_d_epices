<?php

namespace App\Controller; // namespace de la classe actuelle

use App\Repository\DessertRepository;
use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// namespace de la classe Route utilisée en annotation
use Symfony\Component\Routing\Annotation\Route;

// On étend la classe AbstractController pour bénéficier des méthodes et propriétés
// de cette classe dans notre contrôleur
class SwitchMenuController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    // symfony va créer automatiquement l'instance de la classe PlatRepository dans ma variable
    public function Dessert(DessertRepository $dessertRepository, PlatRepository $platRepository){

        // je récupère le jour du serveur sous un format en 3 lettres "Mon, Tue, Wed, Thu, Fri, Sat, Sun"
        $dayAjd = date('D');

        // je recherche dans ma base donnée à l'aide du Repository et ça méthode "findOnrBy" dans ma colonne "jour" de ma base SQL
        $dessert = $dessertRepository->findOneBy(['day' => $dayAjd]);
        $plat = $platRepository->findOneBy(['day' => $dayAjd]);

        // génère une url pour la route dont le nom est 'index.html.twig'
        return $this->render('index.html.twig', [
                'dessert' => $dessert,
                'plat' => $plat
            ]
        );
    }

}