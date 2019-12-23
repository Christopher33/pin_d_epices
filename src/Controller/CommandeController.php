<?php


namespace App\Controller;


use App\Entity\Commande;
use App\Form\CommandeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="app_commande")
     */
    public function commande(Request $request, EntityManagerInterface $entityManager)
    {

        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $commande->setUsers($this->getUser());

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($commande);
                $entityManager->flush();

               return $this->render('security/recap.html.twig');
            }

        return $this->render('security/commande.html.twig', [
            'commande' => $form->createView()
        ]);
    }
}
