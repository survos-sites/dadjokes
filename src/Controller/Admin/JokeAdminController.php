<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Joke;
use App\Form\JokeType;
use App\Repository\JokeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/** Plain server-rendered CRUD — no SPA, matches the ecosystem's admin-favors-pages convention. */
#[Route('/admin/jokes', name: 'admin_joke_')]
final class JokeAdminController extends AbstractController
{
    public function __construct(
        private readonly JokeRepository $jokes,
        private readonly EntityManagerInterface $em,
    ) {
    }

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('admin/joke/index.html.twig', [
            'jokes' => $this->jokes->findBy([], ['category' => 'ASC', 'keyword' => 'ASC']),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $joke = new Joke('', '');
        $form = $this->createForm(JokeType::class, $joke);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($joke);
            $this->em->flush();
            $this->addFlash('success', sprintf('Created "%s".', $joke->getKeyword()));

            return $this->redirectToRoute('admin_joke_index');
        }

        return $this->render('admin/joke/form.html.twig', [
            'form' => $form,
            'joke' => $joke,
            'isNew' => true,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function edit(Joke $joke, Request $request): Response
    {
        $form = $this->createForm(JokeType::class, $joke);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', sprintf('Updated "%s".', $joke->getKeyword()));

            return $this->redirectToRoute('admin_joke_index');
        }

        return $this->render('admin/joke/form.html.twig', [
            'form' => $form,
            'joke' => $joke,
            'isNew' => false,
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(Joke $joke, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete-joke-' . $joke->getId(), (string) $request->request->get('_token'))) {
            $this->em->remove($joke);
            $this->em->flush();
            $this->addFlash('success', 'Joke deleted.');
        }

        return $this->redirectToRoute('admin_joke_index');
    }
}
