<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Entity\Reservation;
use App\Repository\InvoiceRepository;
use App\Repository\ReservationRepository;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class GarageController extends AbstractController
{
    #[Route('/garages', name: 'app_garage')]
    public function index(InvoiceRepository $invoiceRepository, ReservationRepository $reservationRepository, SessionInterface $session): Response
    {
        $login = $this->getUser();
        $customer = $login->getCustomer();

        $pendingReservation = $reservationRepository->findOneBy(['status' => 'Pendiente', 'customer' => $customer]);

        if (!$pendingReservation) {
            $vehicles = [];
        } else {
            $vehicles = $pendingReservation->getVehicle();
        }

        $closedReservations = $reservationRepository->findBy(['status' => 'Completada', 'customer' => $customer]);
        $userInvoices = $invoiceRepository->findBy(['customer' => $customer]);

        // Obtener la fecha seleccionada de la sesión
        $selectedDate = $session->get('selected_date');

        return $this->render('garage/index.html.twig', [
            'vehicles' => $vehicles,
            'invoices' => $userInvoices,
            'reservations' => $closedReservations,
            'selectedDate' => $selectedDate
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
        $vehicle->removeReservation();

        $entityManager->persist($vehicle);
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
            // Manejar el caso en que no haya una reserva pendiente
            $this->addFlash('error', 'No hay una reserva pendiente para completar.');
            return $this->redirectToRoute('app_garage');
        }

        // Calcular el precio total del carrito
        $totalPrice = 0;
        foreach ($pendingReservation->getVehicle() as $vehicle) {
            $totalPrice += $vehicle->getPricePerDay();
        }

        // Crear una nueva factura
        $invoice = new Invoice();

        // Obtener el último número de factura y aumentarlo en uno
        $lastInvoice = $entityManager->getRepository(Invoice::class)->findOneBy([], ['id' => 'DESC']);
        $lastNumber = $lastInvoice ? $lastInvoice->getNumber() : 0;
        $invoice->setNumber($lastNumber + 1);

        // Establecer el precio en base al total del carrito
        $invoice->setPrice($totalPrice);

        $invoice->setDate(new \DateTime());
        $invoice->setDeleted(false);

        $invoice->addReservation($pendingReservation);
        $invoice->setCustomer($customer);
        $entityManager->persist($invoice);
        $entityManager->flush();

        // Actualizar el estado de la reserva a "Completada"
        $pendingReservation->setStatus('Completada');
        $entityManager->persist($pendingReservation);
        $entityManager->flush();

        return $this->redirectToRoute('app_payment_details', ['id' => $invoice->getId()]);
    }
}
