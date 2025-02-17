<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/tag')]
final class TagController extends AbstractController
{
    #[Route('/api', name: 'app_tag_api')]
    public function api(TagRepository $tagRepo, SerializerInterface $serializer): Response
    {
        return JsonResponse::fromJsonString($serializer->serialize($tagRepo->findAll(), 'json', ['groups' => ['tag:read']]));
    }

    // http://localhost:8000/tag/api

    #[Route('/new', name: 'app_tag_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) return $this->redirectToRoute('app_home');
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tag);
            $entityManager->flush();

            return $this->redirectToRoute('app_tag_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tag/new.html.twig', [
            'tag' => $tag,
            'form' => $form,
        ]);
    }
    
    #[Route('/{id}', name: 'app_tag_delete', methods: ['POST'])]
    public function delete(Request $request, Tag $tag, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $tag->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($tag);
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
    }
    
    #[Route('/{id}', name: 'app_tag', methods: ['GET'])]
    public function tag(Tag $tag): Response
    {
        return $this->render('main/tag.html.twig', [
            'tag' => $tag
        ]);
    }
}