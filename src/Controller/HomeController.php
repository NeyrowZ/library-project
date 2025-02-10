<?php

namespace App\Controller;

use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(TagRepository $tagRepo): Response
    {
        $tags = $tagRepo->findAll();
        return $this->render('home/index.html.twig', [
            'tags' => $tags
        ]);
    }
}