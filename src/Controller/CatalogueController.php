<?php

namespace App\Controller;

use App\Entity\Login;
use App\Entity\Reservation;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('PUBLIC_ACCESS')]
class CatalogueController extends AbstractController
{
    #[Route('/catalogue', name: 'app_catalogue_index')]
    public function index(VehicleRepository $vehicleRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $q = $request->query->get('q', '');
        if( empty($q))
            $query = $vehicleRepository->findAllQuery();
        else
            $query = $vehicleRepository->findByTextQuery($q);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('catalogue/index.html.twig', [
            'vehicles' => $pagination,
            'pagination' => $pagination,
            'q' => $q
        ]);
    }

    #[Route('/add/{id}', name: 'app_catalogue_add_vehicle', methods: ['GET', 'POST'])]
    public function new($id, Request $request, EntityManagerInterface $entityManager, VehicleRepository $vehicleRepository): Response {
        // Obtener el usuario logeado
        $login = $this->getUser();

        if (!$login) {
            $this->addFlash(
                'warning',
                "Debes iniciar sesión o registrarte para poder hacer una reserva."
            );
            return $this->redirectToRoute('app_login');
        }

        $customer = $login->getCustomer();

        $existingReservation = $customer->getReservations()->filter(function (Reservation $reservation) {
            return $reservation->getStatus() === 'Pendiente';
        })->first();

        if (!$existingReservation) {
            $reservation = new Reservation();
            $reservation->setStatus('Pendiente');
            $reservation->setStartDate(new \DateTime());
            $reservation->setEndDate(new \DateTime());
            // Obtener el vehículo por su ID
            $vehicle = $vehicleRepository->find($id);
            if ($vehicle) {
                // Establecer el precio del vehículo en la reserva
                $reservation->setTotalPrice($vehicle->getPricePerDay());
            }
            $reservation->setReservationDate(new \DateTime());
            $reservation->setCustomer($customer);
            $reservation->setDeleted(false);

            $entityManager->persist($reservation);

            $vehicleId = $id;
            $vehicle = $vehicleRepository->find($vehicleId);
            $vehicle->addReservation($reservation);

            $entityManager->persist($vehicle);
            $entityManager->flush();
            $entityManager->flush();

            $this->addFlash(
                'success',
                "Se ha creado la reserva correctamente."
            );
        } else {
            $this->addFlash(
                'danger',
                'Ya tienes una reserva pendiente.'
            );
        }

        return $this->redirectToRoute('app_garage', [], Response::HTTP_SEE_OTHER);
    }
}
