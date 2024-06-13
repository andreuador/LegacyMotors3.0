<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Form\InvoiceType;
use App\Repository\InvoiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/invoices')]
#[IsGranted('ROLE_ADMIN')]
class InvoiceController extends AbstractController
{
    #[Route('', name: 'app_invoice_index', methods: ['GET'])]
    public function index(InvoiceRepository $invoiceRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $q = $request->query->get('q', '');

        if (empty($q)) {
            $query = $invoiceRepository->findAllQuery();
        } else
            $query = $invoiceRepository->findByTextQuery($q);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1), 5
        );

        return $this->render('invoice/index.html.twig', [
            'invoices' => $pagination,
            'pagination' => $pagination,
            'query' => $q
        ]);
    }

    #[Route('/new', name: 'app_invoice_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $invoice = new Invoice();
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($invoice);
            $entityManager->flush();

            return $this->redirectToRoute('app_invoice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('invoice/new.html.twig', [
            'invoice' => $invoice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_invoice_show', methods: ['GET'])]
    public function show(Invoice $invoice): Response
    {
        return $this->render('invoice/show.html.twig', [
            'invoice' => $invoice,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_invoice_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Invoice $invoice, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_invoice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('invoice/edit.html.twig', [
            'invoice' => $invoice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_invoice_delete', methods: ['POST', 'GET'])]
    public function delete(Request $request, Invoice $invoice, EntityManagerInterface $entityManager): Response
    {
        $invoice->setDeleted(true);
        $entityManager->persist($invoice);
        $entityManager->flush();

        /*if ($this->isCsrfTokenValid('delete'.$invoice->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($invoice);
            $entityManager->flush();
        }*/

        return $this->redirectToRoute('app_invoice_index', [], Response::HTTP_SEE_OTHER);
    }
}
