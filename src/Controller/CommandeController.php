<?php


namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
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
    public function commande(Request $request, EntityManagerInterface $entityManager, PlatRepository $platRepository)
    {

        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        $request->getPathInfo();
        $NbPlat = 1;
        $dayAjd = date('D');
        $plat = $platRepository->findOneBy(['day' => $dayAjd]);
        $price = $plat->getPrice();
        $nombre = $NbPlat;

        $total = $nombre * $price;

        //dd($NbPlat);

        if ($form->isSubmitted() && $form->isValid()) {

            $commande->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commande);
            $entityManager->flush();

            return $this->render('security/Recap.html.twig');
        }

        return $this->render('security/commande.html.twig', [
            'commande' => $form->createView(),
            'total' => $total
        ]);
    }

    /**
     * @Route("/calcul", name="app_calcul")
     */
    public function calculPlat(Request $request, PlatRepository $platRepository)
    {
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

