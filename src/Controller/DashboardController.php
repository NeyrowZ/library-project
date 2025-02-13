<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(UserRepository $userRepo, BookRepository $bookRepo): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_home');
        } else {
            $users = $userRepo->findAll();
            $books = $bookRepo->findAll();
            return $this->render('dashboard/index.html.twig', [
                'users' => $users,
                'books' => $books
            ]);
        }
    }
}