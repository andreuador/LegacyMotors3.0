<?php

namespace App\Controller;

use App\Entity\Vehicle;
use App\Form\VehicleType;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/vehicles')]
#[IsGranted('ROLE_ADMIN')]
class VehicleController extends AbstractController
{
    #[Route('', name: 'app_vehicle_index', methods: ['GET'])]
    public function index(Request $request, PaginatorInterface $paginator, VehicleRepository $vehicleRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Accés restringit, soles administradors');
        $q = $request->get('q', '');

        if (empty($q))
            $query = $vehicleRepository->findAllQuery();
        else
            $query = $vehicleRepository->findByTextQuery($q);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1), 5
        );

        return $this->render('vehicle/index.html.twig', [
            'vehicles' => $pagination->getItems(),
            'pagination' => $pagination,
            'q' => $q,
        ]);
    }

    #[Route('/new', name: 'app_vehicle_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vehicle = new Vehicle();
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vehicle);
            $entityManager->flush();

            return $this->redirectToRoute('app_vehicle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vehicle/new.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_vehicle_show', methods: ['GET'])]
    public function show(Vehicle $vehicle): Response
    {
        return $this->render('vehicle/show.html.twig', [
            'vehicle' => $vehicle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_vehicle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vehicle $vehicle, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_vehicle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vehicle/edit.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_vehicle_delete', methods: ['POST', 'GET'])]
    public function delete(Request $request, Vehicle $vehicle, EntityManagerInterface $entityManager): Response
    {

        $vehicle->setDeleted(true);
        $entityManager->persist($vehicle);
        $entityManager->flush();
        /*if ($this->isCsrfTokenValid('delete'.$vehicle->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($vehicle);
            $entityManager->flush();
        }*/

        return $this->redirectToRoute('app_vehicle_index', [], Response::HTTP_SEE_OTHER);
    }
}
