<?php


namespace App\Controller;


use App\Entity\Commande;
use App\Repository\CommandeRepository;
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
     * @Route("/", name="app_admin")
     */
    public function adminDashboard()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Vous n\'avez aucun pouvoir ici');

        return $this->render('security/admin.html.twig');
    }

    /**
     * @Route("/coco", name="commande_index", methods={"GET"})
     * @param CommandeRepository $commandeRepository
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index(CommandeRepository $commandeRepository, UserRepository $userRepository): Response
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
}