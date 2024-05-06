<?php

namespace App\Controller;

use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BackOfficeController extends AbstractController
{
    #[Route('/backoffice', name: 'app_back_office')]
    public function index(VehicleRepository $vehicleRepository): Response
    {

        // Obtindre tots els vehicles
        $vehicles = $vehicleRepository->findAll();

        // Seleccionar 5 vehicles aleatoriament
        shuffle($vehicles);
        $randomVehicles = array_slice($vehicles, 0, 5);

        // Contador de les ventes de cada marca
        $brandSalesCount = [];

        // Contar les ventes
        foreach ($vehicles as $vehicle) {
            $brand = $vehicle->getBrand()->getName();
            if (!isset($brandSalesCount[$brand])) {
                $brandSalesCount[$brand] = 0;
            }
        }
        $totalSales = count($vehicles);

        // Calcular el percentatge de ventes per a cada marca
        $brandSalesPercentage = [];
        foreach ($brandSalesCount as $brand => $count) {
            $brandSalesPercentage[$brand] = ($count / $totalSales) * 100;
        }

        $topBrands = array_slice($brandSalesPercentage, 0, 5);

        return $this->render('back_office/index.html.twig', [
            'vehicles' => $randomVehicles,
            'topBrands' => $topBrands,
        ]);
    }
}
