<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Entity\Reservation;
use App\Entity\PaymentDetails;
use App\Form\PaymentDetailsType;
use App\Repository\InvoiceRepository;
use App\Repository\PaymentDetailsRepository;
use App\Repository\ReservationRepository;
use App\Repository\VehicleRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class GarageController extends AbstractController
{
    #[Route('/garages', name: 'app_garage')]
    public function index(InvoiceRepository $invoiceRepository, ReservationRepository $reservationRepository, SessionInterface $session, Request $request, EntityManagerInterface $entityManager): Response
    {
        $login = $this->getUser();
        $customer = $login->getCustomer();

        $pendingReservation = $reservationRepository->findOneBy(['status' => 'Pendiente', 'customer' => $customer]);

        if (!$pendingReservation) {
            $vehicles = [];
        } else {
            $vehicles = $pendingReservation->getVehicles();
        }

        $closedReservations = $reservationRepository->findBy(['status' => 'Completada', 'customer' => $customer]);
        $userInvoices = $invoiceRepository->findBy(['customer' => $customer]);

        // Obtener la fecha seleccionada de la sesión
        $selectedDate = $session->get('selected_date');

        // Crear el formulario de detalles de pago
        $paymentDetails = $customer->getPaymentDetails()->first();
        $isNewPayment = false;
        if (!$paymentDetails) {
            $paymentDetails = new PaymentDetails();
            $isNewPayment = true;
        }
        $paymentDetailsForm = $this->createForm(PaymentDetailsType::class, $paymentDetails);
        $paymentDetailsForm->handleRequest($request);

        if ($paymentDetailsForm->isSubmitted() && $paymentDetailsForm->isValid()) {
            $paymentDetails = $paymentDetailsForm->getData();
            $paymentDetails->setCustomer($customer);

            $entityManager->persist($paymentDetails);
            $entityManager->flush();

            $this->addFlash('success', 'Los detalles de pago se han guardado correctamente.');
            return $this->redirectToRoute('app_garage');
        }

        return $this->render('garage/index.html.twig', [
            'vehicles' => $vehicles,
            'invoices' => $userInvoices,
            'reservations' => $closedReservations,
            'selectedDate' => $selectedDate,
            'form' => $paymentDetailsForm->createView(),
        ]);
    }

    #[Route('/add-to-cart', name: 'app_garage_add_to_cart', methods: ['POST'])]
    public function addToCart(Request $request, ReservationRepository $reservationRepository, VehicleRepository $vehicleRepository, EntityManagerInterface $entityManager): Response
    {
        $vehicleId = $request->request->get('vehicle_id');
        $date = $request->request->get('date');

        $vehicle = $vehicleRepository->find($vehicleId);
        $login = $this->getUser();
        $customer = $login->getCustomer();

        $pendingReservation = $reservationRepository->findOneBy(['status' => 'Pendiente', 'customer' => $customer]);

        if (!$pendingReservation) {
            $pendingReservation = new Reservation();
            $pendingReservation->setStatus('Pendiente');
            $pendingReservation->setCustomer($customer);
            $pendingReservation->setDeleted(false);
            $entityManager->persist($pendingReservation);
        }

        $pendingReservation->addVehicle($vehicle);
        $entityManager->persist($pendingReservation);
        $entityManager->flush();

        return $this->redirectToRoute('app_details_vehicle', ['id' => $vehicleId]);
    }

    #[Route('/delete/{id}', name: 'app_garage_delete_vehicle')]
    public function remove($id, VehicleRepository $vehicleRepository, EntityManagerInterface $entityManager): Response
    {
        $vehicleId = $id;
        $vehicle = $vehicleRepository->find($vehicleId);
        foreach ($vehicle->getReservations() as $reservation) {
            $reservation->setStatus('Cancelado');
            $entityManager->persist($reservation);
        }

        $entityManager->flush();

        return $this->redirectToRoute('app_garage', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/checkout', name: 'app_garage_checkout', methods: ['POST', 'GET'])]
    public function checkout(InvoiceRepository $invoiceRepository, ReservationRepository $reservationRepository, EntityManagerInterface $entityManager): Response
    {
        // Obtener la reserva pendiente del usuario
        $login = $this->getUser();
        $customer = $login->getCustomer();
        $pendingReservation = $reservationRepository->findOneBy(['status' => 'Pendiente', 'customer' => $customer]);

        if (!$pendingReservation) {
            $this->addFlash('danger', 'No hay una reserva pendiente para completar.');
            return $this->redirectToRoute('app_garage');
        }

        // Crear nuevos detalles de pago
        $paymentDetails = new PaymentDetails();
        $paymentDetails->setCustomer($customer);

        $existingPaymentDetails = $customer->getPaymentDetails()->first();
        if ($existingPaymentDetails) {
            $paymentDetails->setCardNumber($existingPaymentDetails->getCardNumber());
            $paymentDetails->setExpiryDate($existingPaymentDetails->getExpiryDate());
            $paymentDetails->setCvv($existingPaymentDetails->getCvv());
            $paymentDetails->setPaymentMethod($existingPaymentDetails->getPaymentMethod());
        }

        $entityManager->persist($paymentDetails);

        // Calcular el precio total del carrito
        $totalPrice = 0;
        foreach ($pendingReservation->getVehicles() as $vehicle) {
            $totalPrice += $vehicle->getPricePerDay();
        }

        // Obtener el último número de factura
        $lastInvoice = $invoiceRepository->findOneBy([], ['id' => 'DESC']);
        $lastNumber = $lastInvoice ? $lastInvoice->getNumber() : 5;
        $newInvoiceNumber = $lastNumber + 1;

        $invoice = new Invoice();
        $invoice->setNumber($newInvoiceNumber);
        $invoice->setPrice($totalPrice);
        $invoice->setDate(new DateTime());
        $invoice->setDeleted(false);
        $invoice->addReservation($pendingReservation);
        $invoice->setCustomer($customer);

        $pendingReservation->setStatus('Completada');
        $pendingReservation->setPaymentDetails($paymentDetails);
        $entityManager->persist($pendingReservation);
        $entityManager->persist($invoice);
        $entityManager->flush();

        $this->addFlash('success', 'Reserva realizada con éxito.');

        return $this->redirectToRoute('app_garage');
    }
}
