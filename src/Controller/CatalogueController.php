<?php

namespace App\Controller;

use App\Entity\Login;
use App\Entity\Order;
use App\Entity\Reservation;
use App\Form\OrderType;
use App\Repository\OrderRepository;
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
        $user = $this->getUser();

        dump($user);

        // Verificar si el usuario está autenticado y tiene un cliente asociado
        if (!$user || !$user->isAuthenticated() || !$user->getCustomer()) {
            // Si el usuario no está autenticado o no tiene un cliente asociado, redirigirlo a la página de inicio
            return $this->redirectToRoute('app_default');
        }

        $customer = $user->getCustomer();

        $existingReservation = $customer->getReservations()->filter(function (Reservation $reservation) {
            return $reservation->getStatus() === 'pending';
        })->first();

        if (!$existingReservation) {
            $reservation = new Reservation();
            $reservation->setStatus('pending');
            $reservation->setCustomer($customer);
            $reservation->setDeleted(false);

            $form = $this->createForm(ReservationType::class, $reservation);
            $form->handleRequest($request);

            $entityManager->persist($reservation);
            $entityManager->flush();

            $vehicleId = $id;
            $vehicle = $vehicleRepository->find($vehicleId);
            $vehicle->setReservation($reservation);

            $entityManager->persist($vehicle);
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
