<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Obtener el cliente actual
        $login = $this->getUser();
        $customer = $entityManager->getRepository(Customer::class)->findOneBy(['login' => $login]);

        if (!$customer) {
            throw $this->createNotFoundException('No existe este cliente.');
        }

        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Perfil actualizado correctamente.');
            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/index.html.twig', [
            'customer' => $customer,
            'form' => $form->createView(),
        ]);
    }
}