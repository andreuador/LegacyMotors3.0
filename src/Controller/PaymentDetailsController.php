<?php

namespace App\Controller;

use App\Entity\PaymentDetails;
use App\Form\PaymentDetailsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PaymentDetailsController extends AbstractController
{
    #[Route('/payment/details', name: 'app_payment_details')]
    public function index(): Response
    {
        // Obtener el usuario actual y su cliente asociado
        $customer = $this->getUser()->getCustomer();

        // Verificar si el Customer existe y obtener sus detalles de pago
        if ($customer) {
            $paymentDetails = $customer->getPaymentDetails();
        } else {
            $paymentDetails = null;
        }

        // Crear una nueva instancia de PaymentDetails
        $paymentDetailsForm = new PaymentDetails();
        $form = $this->createForm(PaymentDetailsType::class, $paymentDetailsForm);

        // Renderizar la plantilla twig con el formulario
        return $this->render('payment_details/index.html.twig', [
            'paymentDetails' => $paymentDetails,
            'form' => $form->createView(),
        ]);

    }

   /* #[Route('/payment/details/edit', name: 'app_payment_details_edit')]
    public function edit(Request $request): Response
    {
        $paymentDetails = $this->getUser()->getPaymentDetails() ?? new PaymentDetails();
        $form = $this->createForm(PaymentDetailsType::class, $paymentDetails);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Guardar los detalles de pago actualizados en la base de datos
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($paymentDetails);
            $entityManager->flush();

            $this->addFlash('success', 'Los detalles de pago se han actualizado correctamente.');

            return $this->redirectToRoute('app_payment_details');
        }

        return $this->render('payment_details/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }*/
}
