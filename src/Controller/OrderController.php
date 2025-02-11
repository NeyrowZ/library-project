<?php

namespace App\Controller;
use App\Repository\BookRepository;
use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use DateTimeImmutable;
use DateTimeZone;

#[Route('/order')]
final class OrderController extends AbstractController
{
    #[Route('/book', name: 'app_order_book', methods: ['POST'])]
    public function book(Request $request, BookRepository $bookRepo, EntityManagerInterface $entityManager): Response
    {
        $id = $request->request->get('id');
        
        $book = $bookRepo->find($id);
        if (!$book) {
            throw $this->createNotFoundException('Le livre n\'existe pas');
        }
        $order = new Order();
        $order->setDate(new DateTimeImmutable('now', new DateTimeZone('Europe/Paris')));
        $order->setReturnDate(new DateTimeImmutable('+2 week', new DateTimeZone('Europe/Paris')));
        $order->setUser($this->getUser());
        $order->addBook($book);

        $entityManager->persist($order);
        $entityManager->flush();
        return $this->redirectToRoute('app_account');
    }

    #[Route('/cart', name: 'app_order_cart', methods: ['POST'])]
    public function cart(SessionInterface $session, EntityManagerInterface $entityManager): Response
    {
        $cart = $session->get('cart') ?? [];
        if ($cart !== []) {
            $order = new Order();
            $order->setDate(new DateTimeImmutable('now', new DateTimeZone('Europe/Paris')));
            $order->setReturnDate(new DateTimeImmutable('+2 week', new DateTimeZone('Europe/Paris')));
            $order->setUser($this->getUser());
            foreach ($cart as $book) {
                
            }

            $entityManager->persist($order);
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_home');
    }
}
