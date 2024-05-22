<?php

namespace App\Controller;

use App\Entity\Vehicle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/details/vehicle')]
class DetailsVehicleController extends AbstractController
{
    #[Route('/{id}', name: 'app_details_vehicle')]
    public function index(Vehicle $vehicle): Response
    {
        // Obtener las reservas del vehículo
        $reservations = $vehicle->getReservation();
        $reservedDates = [];

        // Obtener todas las fechas reservadas
        foreach ($reservations as $reservation) {
            $period = new \DatePeriod(
                $reservation->getStartDate(),
                new \DateInterval('P1D'),
                $reservation->getEndDate()->modify('+1 day')
            );

            foreach ($period as $date) {
                $reservedDates[] = $date->format('Y-m-d');
            }
        }

        // Calcular algunas fechas disponibles para reservar (por ejemplo, los próximos 7 días)
        $availableDates = [];
        $currentDate = new \DateTime();
        for ($i = 1; $i <= 15; $i++) {
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

    #[Route('/{id}/reservations', name: 'app_details_vehicle_reservations')]
    public function reservations(Vehicle $vehicle): Response
    {
        // Obtener las reservas del vehículo
        $reservations = $vehicle->getReservation();

        return $this->render('details_vehicle/index.html.twig', [
            'vehicle' => $vehicle,
            'reservations' => $reservations,
        ]);
    }
}