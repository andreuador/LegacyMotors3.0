<?php

namespace App\Controller;

use App\Entity\Order;
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
    public function new($id, Request $request, EntityManagerInterface $entityManager, OrderRepository $orderRepository, VehicleRepository $vehicleRepository): Response {
        /*if ($this->isGranted('ROLE_ADMIN')) {
            $this->addFlash(
                'warning',
                "Sols els clients poden realitzar compres"
            );
            return $this->redirectToRoute('templates');
        }*/

        $login = $this->getUser();
        $customer = $login->getCustomer();

        $existingOrder = $orderRepository->findOneBy(['state' => 'En proceso', 'customer' => $customer]);

        if (!$existingOrder) {
            $order = new Order();
            $order->setState('En proceso');
            $order->setCustomer($customer);
            $order->setDeleted(false);

            $form = $this->createForm(OrderType::class, $order);
            $form->handleRequest($request);

            $entityManager->persist($order);
            $entityManager->flush();

            $vehicleId = $id;
            $vehicle = $vehicleRepository->find($vehicleId);
            $vehicle->setVehicleOrder($order);

            $entityManager->persist($vehicle);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "Se ha creado la reserva correctamente."
            );
        } else {
            $order = $existingOrder;

            $vehicleId = $id;
            $vehicle = $vehicleRepository->find($vehicleId);

            if ($vehicle->getVehicleOrder() !== null) {
                $this->addFlash(
                    'danger',
                    'El vehículo ya no esta disponible.'
                );
            } else {
                $vehicle->setVehicleOrder($order);

                $entityManager->persist($vehicle);
                $entityManager->flush();

                $this->addFlash(
                    'success',
                    'Vehículo agregado correctamente.'
                );
            }
        }

        return $this->redirectToRoute('app_garage', [], Response::HTTP_SEE_OTHER);
    }
}
