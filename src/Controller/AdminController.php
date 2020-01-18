<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Dessert;
use App\Entity\Plat;
use App\Form\DessertType;
use App\Form\PlatType;
use App\Repository\CommandeRepository;
use App\Repository\DessertRepository;
use App\Repository\PlatRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * page d'accueil de l'admin, vérification du role admin pour avoir accès.
     * @Route("/", name="app_admin")
     */
    public function adminDashboard()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Vous n\'avez aucun pouvoir ici');

        return $this->render('security/admin.html.twig');
    }

    /**
     * page des commandes enregistrées dans la base de données
     * @Route("/coco", name="commande_index", methods={"GET"})
     * @param CommandeRepository $commandeRepository
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index(CommandeRepository $commandeRepository): Response
    {
        $date = date('d / m');
        $commande = $commandeRepository->findAll();

        return $this->render('commande/index.html.twig', [
            'commandes' => $commande,
            'date' => $date
        ]);
    }

    /**
     * @Route("/{id}", name="commande_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Commande $commande): Response
    {
            if ($this->isCsrfTokenValid('delete'.$commande->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($commande);
                $entityManager->flush();
            }

        return $this->redirectToRoute('commande_index');
    }

//Controller admin for changing "Plat" entity
    /**
     * @Route("/plat", name="plat_index", methods={"GET"})
     */
    public function indexPlat(PlatRepository $platRepository): Response
    {
        return $this->render('plat/index.html.twig', [
            'plats' => $platRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/plat_edit", name="plat_edit", methods={"GET","POST"})
     */
    public function editPlat(Request $request, Plat $plat): Response
    {
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('plat_index');
            }

        return $this->render('plat/edit.html.twig', [
            'plat' => $plat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/dessert", name="dessert_index", methods={"GET"})
     */
    public function indexDessert(DessertRepository $dessertRepository): Response
    {
        return $this->render('dessert/index.html.twig', [
            'desserts' => $dessertRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/dessert_edit", name="dessert_edit", methods={"GET","POST"})
     */
    public function editDessert(Request $request, Dessert $dessert): Response
    {
        $form = $this->createForm(DessertType::class, $dessert);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('dessert_index');
            }

        return $this->render('dessert/edit.html.twig', [
            'dessert' => $dessert,
            'form' => $form->createView(),
        ]);
    }
}