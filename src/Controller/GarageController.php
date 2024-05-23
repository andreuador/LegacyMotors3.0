<?php

namespace App\Controller;

use App\Entity\Vehicle;
use App\Repository\InvoiceRepository;
use App\Repository\OrderRepository;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class GarageController extends AbstractController
{
    #[Route('/garages', name: 'app_garage')]
    public function index(InvoiceRepository $invoiceRepository, OrderRepository $orderRepository, SessionInterface $session): Response
    {
        $login = $this->getUser();
        $customer = $login->getCustomer();

        $pendingOrder = $orderRepository->findOneBy(['state' => 'En proceso', 'customer' => $customer]);

        if (!$pendingOrder) {
            $vehicles = [];
        } else {
            $vehicles = $pendingOrder->getVehicle()->toArray();
        }

        $closedOrders = $orderRepository->findBy(['state' => 'Completado', 'customer' => $customer]);
        $userInvoices = $invoiceRepository->findBy(['customer' => $customer]);

        // Obtener la fecha seleccionada de la sesión
        $selectedDate = $session->get('selected_date');


        return $this->render('garage/index.html.twig', [
            'vehicles' => $vehicles,
            'invoices' => $userInvoices,
            'orders' => $closedOrders,
            'selectedDate' => $selectedDate
        ]);
    }

    #[Route('/add-to-cart', name: 'app_garage_add_to_cart', methods: ['POST'])]
    public function addToCart(Request $request, OrderRepository $orderRepository, VehicleRepository $vehicleRepository, EntityManagerInterface $entityManager): Response
    {
        $vehicleId = $request->request->get('vehicle_id');
        $date = $request->request->get('date');

        $vehicle = $vehicleRepository->find($vehicleId);
        $login = $this->getUser();
        $customer = $login->getCustomer();

        $pendingOrder = $orderRepository->findOneBy(['state' => 'En proceso', 'customer' => $customer]);

        if (!$pendingOrder) {
            $pendingOrder = new Order();
            $pendingOrder->setCustomer($customer);
            $pendingOrder->setState('En proceso');
            $entityManager->persist($pendingOrder);
        }

        $pendingOrder->addVehicle($vehicle);
        $entityManager->persist($pendingOrder);
        $entityManager->flush();

        return $this->redirectToRoute('app_details_vehicle', ['id' => $vehicleId]);
    }

    #[Route('/delete/{id}', name: 'app_garage_delete_vehicle')]
    public function remove($id, VehicleRepository $vehicleRepository, EntityManagerInterface $entityManager): Response {
        $vehicleId = $id;
        $vehicle = $vehicleRepository->find($vehicleId);
        $vehicle->setVehicleOrder(null);

        $entityManager->persist($vehicle);
        $entityManager->flush();

        return $this->redirectToRoute('app_garage', [], Response::HTTP_SEE_OTHER);
    }
}
