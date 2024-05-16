<?php

namespace App\Controller;

use App\Repository\VehicleRepository;
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
}
