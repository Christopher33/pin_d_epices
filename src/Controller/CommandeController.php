<?php


namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\DessertRepository;
use App\Repository\PlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="app_commande")
     */
    public function commande(Request $request, EntityManagerInterface $entityManager, PlatRepository $platRepository, DessertRepository $dessertRepository)
    {

        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        $request->getPathInfo();
        $dayAjd = date('D');

        $plat = $platRepository->findOneBy(['day' => $dayAjd]);
        $pricePlat = $plat->getPrice();

        $dessert = $dessertRepository->findOneBy(['day' => $dayAjd]);
        $priceDessert = $dessert->getPrice();

        if ($form->isSubmitted() && $form->isValid()) {

            $commande->setUser($this->getUser());

            $a = $commande->getPlat() * $pricePlat;
            $b = $commande->getDessert() * $priceDessert;
            $c = $commande->getCanette() * 2;
            $d = $commande->getEau() * 1.5;
            $e = $commande->getBoisson() * 1.5;

            $total = $a + $b + $c + $d + $e;

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commande);
            $entityManager->flush();

            return $this->render('security/Recap.html.twig', [
                'rendu' => $commande,
                'total' => $total,
                'totPlat' => $a,
                'totDessert' => $b,
                'totCanette' => $c,
                'totEau' => $d,
                'totBoisson' => $e
                ]);
        }

        return $this->render('security/commande.html.twig', [
            'commande' => $form->createView(),
        ]);
    }

    /**
     * @Route("/calcul", name="app_calcul")
     */
    public function calculPlat(Request $request, PlatRepository $platRepository)
    {
        if($request->isXmlHttpRequest()) {
            $request->getPathInfo();
            $NbPlat = $request->query->getInt('plat');
            $dayAjd = date('D');
            $plat = $platRepository->findOneBy(['day' => $dayAjd]);
            $price = $plat->getPrice();
            $nombre = $NbPlat;

            $total = $nombre * $price;

            return new Response($total, 200);
        }
    }
}

