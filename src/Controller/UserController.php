<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]
final class UserController extends AbstractController
{

    #[Route('/{id}', name: 'app_user_action', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        } else if ($this->isCsrfTokenValid('admin' . $user->getId(), $request->getPayload()->getString('_token'))) {
            $user->addRole('ROLE_ADMIN');
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
    }

    // #[Route('/{id}', name: 'app_user_admin', methods: ['POST'])]
    // public function admin(Request $request, User $user, EntityManagerInterface $entityManager): Response
    // {
    //     if ($this->isCsrfTokenValid('admin' . $user->getId(), $request->getPayload()->getString('_token'))) {
    //         $user->addRole('ROLE_ADMIN');
    //         $entityManager->flush();
    //     }
    //     return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    // }





    // #[Route('/new', name: 'app_book_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    // {
    //     $book = new Book();
    //     $form = $this->createForm(BookType::class, $book);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $imageFile = $form->get('cover')->getData();
    //         if ($imageFile) {
    //             $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
    //             $safeFilename = $slugger->slug($originalFilename);
    //             $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
    //             $imageFile->move( 
    //                 $this->getParameter('images_directory'),
    //                 $newFilename
    //             ); 
    //             $book->setCover($newFilename);
    //         }

    //         $entityManager->persist($book);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_book_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('book/new.html.twig', [
    //         'book' => $book,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}/edit', name: 'app_book_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, Book $book, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    // {
    //     $form = $this->createForm(BookType::class, $book);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $imageFile = $form->get('cover')->getData();
    //         if ($imageFile) {
    //             $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
    //             $safeFilename = $slugger->slug($originalFilename);
    //             $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
    //             $imageFile->move( 
    //                 $this->getParameter('images_directory'),
    //                 $newFilename
    //             ); 
    //             $book->setCover($newFilename);
    //         }

    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('book/edit.html.twig', [
    //         'book' => $book,
    //         'form' => $form,
    //     ]);
    // }
}