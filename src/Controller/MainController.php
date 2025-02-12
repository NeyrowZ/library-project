<?php

namespace App\Controller;

use App\Repository\TagRepository;
use App\Entity\Book;
use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(TagRepository $tagRepo): Response
    {
        $tags = $tagRepo->findAll();
        return $this->render('main/home.html.twig', [
            'tags' => $tags
        ]);
    }

    #[Route('/tag/{id}', name: 'app_tag')]
    public function tag(Tag $tag): Response
    {
        return $this->render('main/tag.html.twig', [
            'tag' => $tag
        ]);
    }

    #[Route('/book/{id}', name: 'app_book')]
    public function book(Book $book): Response
    {
        return $this->render('main/book.html.twig', [
            'book' => $book
        ]);
    }
}