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
}