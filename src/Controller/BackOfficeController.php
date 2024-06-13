<?php

namespace App\Controller;

use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class BackOfficeController extends AbstractController
{
    #[Route('/admin/backoffice', name: 'app_back_office')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(VehicleRepository $vehicleRepository): Response
    {
        // Obtener todos los vehículos
        $vehicles = $vehicleRepository->findAll();

        // Seleccionar 5 vehículos aleatoriamente
        shuffle($vehicles);
        $randomVehicles = array_slice($vehicles, 0, 2);

        // Contador de las ventas de cada marca
        $brandSalesCount = [];

        // Contar las ventas
        foreach ($vehicles as $vehicle) {
            $brand = $vehicle->getBrand()->getName();
            if (!isset($brandSalesCount[$brand])) {
                $brandSalesCount[$brand] = 0;
            }
            $brandSalesCount[$brand]++;
        }

        $totalSales = count($vehicles);

        // Calcular el porcentaje de ventas para cada marca
        $brandSalesPercentage = [];
        foreach ($brandSalesCount as $brand => $count) {
            $brandSalesPercentage[$brand] = ($count / $totalSales) * 100;
        }

        // Ordenar las marcas por porcentaje de ventas en orden descendente
        arsort($brandSalesPercentage);

        // Seleccionar las top 5 marcas
        $topBrands = array_slice($brandSalesPercentage, 0, 2, true);

        return $this->render('back_office/index.html.twig', [
            'vehicles' => $randomVehicles,
            'topBrands' => $topBrands,
        ]);
    }
}
