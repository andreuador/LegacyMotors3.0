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

        return $this->render('details_vehicle/index.html.twig', [
            'vehicle' => $vehicle,
        ]);
    }
}