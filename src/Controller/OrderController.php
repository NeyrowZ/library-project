<?php

namespace App\Controller;
use App\Entity\Order;
use App\Entity\Book;
use App\Repository\BookRepository;
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
        if ($this->getUser()) {
            $order = new Order();
            $order->setDate(new DateTimeImmutable('now', new DateTimeZone('Europe/Paris')));
            $order->setReturnDate(new DateTimeImmutable('+2 week', new DateTimeZone('Europe/Paris')));
            $order->setUser($this->getUser());
            $order->addBook($bookRepo->find($request->request->get('id')));

            $entityManager->persist($order);
            $entityManager->flush();
            return $this->redirectToRoute('app_account');
        }
        return $this->redirectToRoute('app_home');
    }

    #[Route('/cart', name: 'app_order_cart', methods: ['POST'])]
    public function cart(SessionInterface $session, BookRepository $bookRepo, EntityManagerInterface $entityManager): Response
    {
        $cart = $session->get('cart') ?? [];
        if ($this->getUser() && $cart !== []) {
            $order = new Order();
            $order->setDate(new DateTimeImmutable('now', new DateTimeZone('Europe/Paris')));
            $order->setReturnDate(new DateTimeImmutable('+2 week', new DateTimeZone('Europe/Paris')));
            $order->setUser($this->getUser());

            $ids = [];
            foreach ($cart as $book) {
                $ids[] = $book->getId();
            }
            $order->addBooks($bookRepo->findBy(['id' => $ids]));

            $entityManager->persist($order);
            $entityManager->flush();
            $session->set('cart', []);
            return $this->redirectToRoute('app_account');
        }
        return $this->redirectToRoute('app_home');
    }
}
