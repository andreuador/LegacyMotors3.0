<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\EmployeeType;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('admin/employees')]
#[IsGranted('ROLE_ADMIN')]
class EmployeeController extends AbstractController
{

    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/', name: 'app_employee_index', methods: ['GET'])]
    public function index(EmployeeRepository $employeeRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $q = $request->query->get('q', '');

        if (empty($q)) {
            $employeeQuery = $employeeRepository->findAllQuery();
        } else {
            $employeeQuery = $employeeRepository->findByText($q);
        }

        $pagination = $paginator->paginate(
            $employeeQuery,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('employee/index.html.twig', [
            'employees' => $pagination,
            'pagination' => $pagination,
            'q' => $q,
        ]);
    }

    #[Route('/new', name: 'app_employee_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $login = $employee->getLogin();
            $login->setRole('ROLE_ADMIN');
            $employee->setDeleted(false);

            // Codificar la contraseña
            $encodedPassword = $this->passwordHasher->hashPassword($login, $login->getPassword());
            $login->setPassword($encodedPassword);

            $entityManager->persist($login);
            $entityManager->persist($employee);
            $entityManager->flush();

            return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('employee/new.html.twig', [
            'employee' => $employee,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_employee_show', methods: ['GET'])]
    public function show(Employee $employee): Response
    {
        return $this->render('employee/show.html.twig', [
            'employee' => $employee,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_employee_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Employee $employee, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('employee/edit.html.twig', [
            'employee' => $employee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_employee_delete', methods: ['POST', 'GET'])]
    public function delete(Request $request, Employee $employee, EntityManagerInterface $entityManager): Response
    {
        $employee->setDeleted(true);
        $entityManager->persist($employee);
        $entityManager->flush();

        /*if ($this->isCsrfTokenValid('delete'.$employee->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($employee);
            $entityManager->flush();
        }*/

        return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
    }
}
