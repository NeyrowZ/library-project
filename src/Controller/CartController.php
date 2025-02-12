<?php

namespace App\Controller;
use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

#[Route('/cart')]
final class CartController extends AbstractController
{
    #[Route('/add', name: 'app_cart_add', methods: ['POST'])]
    public function add(Request $request, SessionInterface $session, BookRepository $bookRepo): Response
    {
        $bookId = $request->request->get('id');
        $cart = $session->get('cart') ?? [];
        if (count($cart) < 5) {
            $cart[] = $bookRepo->find($bookId);
        }
        $session->set('cart', $cart);
        return $this->redirectToRoute('app_home');
    }
}
