<?php

namespace App\Controller;

use App\Entity\Vehicle;
use DateInterval;
use DatePeriod;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('PUBLIC_ACCESS')]
#[Route('/details/vehicle')]
class DetailsVehicleController extends AbstractController
{
    #[Route('/{id}', name: 'app_details_vehicle')]
    public function index(Vehicle $vehicle): Response
    {
        // Obtener las reservas del vehículo
        $reservations = $vehicle->getReservations();
        $reservedDates = [];
        $currentDate = new \DateTime();

        // Obtener todas las fechas reservadas, excluyendo las pasadas
        foreach ($reservations as $reservation) {
            if ($reservation->getEndDate() >= $currentDate) {
                $period = new DatePeriod(
                    $reservation->getStartDate(),
                    new DateInterval('P1D'),
                    $reservation->getEndDate()->modify('+1 day')
                );

                foreach ($period as $date) {
                    if ($date >= $currentDate) {
                        $reservedDates[] = $date->format('Y-m-d');
                    }
                }
            }
        }

        // Calcular algunas fechas disponibles para reservar
        $availableDates = [];
        for ($i = 1; $i <= 30; $i++) {
            $availableDate = clone $currentDate;
            $availableDate->modify("+$i day");

            // Si la fecha no está reservada, añadirla a las fechas disponibles
            if (!in_array($availableDate->format('Y-m-d'), $reservedDates)) {
                $availableDates[] = $availableDate;
            }
        }

        return $this->render('details_vehicle/index.html.twig', [
            'vehicle' => $vehicle,
            'reservations' => $reservations,
            'availableDates' => $availableDates,
        ]);
    }

    #[Route('/{id}/add-to-cart', name: 'app_details_vehicle_add_to_cart', methods: ['POST'])]
    public function addToCart($id, Request $request, SessionInterface $session): Response
    {
        $selectedDate = $request->request->get('date');

        if (!$selectedDate) {
            $this->addFlash('error', 'No se ha seleccionado ninguna fecha.');
            return $this->redirectToRoute('app_details_vehicle', ['id' => $id]);
        }

        // Almacenar la fecha seleccionada en la sesión
        $session->set('selected_date', $selectedDate);

        return $this->redirectToRoute('app_catalogue_add_vehicle', ['id' => $id]);
    }
}
