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
            'jokes' => $this->jokes->findAllOrdered(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $joke = new Joke('', '', sortOrder: $this->jokes->nextSortOrder());
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

    #[Route('/{id}/move-up', name: 'move_up', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function moveUp(Joke $joke, Request $request): Response
    {
        $this->swapSortOrder($joke, $request, -1);

        return $this->redirectToRoute('admin_joke_index');
    }

    #[Route('/{id}/move-down', name: 'move_down', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function moveDown(Joke $joke, Request $request): Response
    {
        $this->swapSortOrder($joke, $request, 1);

        return $this->redirectToRoute('admin_joke_index');
    }

    /** Swaps sortOrder with the joke's neighbor in the current ordering — no gaps/renumbering needed. */
    private function swapSortOrder(Joke $joke, Request $request, int $direction): void
    {
        if (!$this->isCsrfTokenValid('move-joke-' . $joke->getId(), (string) $request->request->get('_token'))) {
            return;
        }

        $ordered = $this->jokes->findAllOrdered();
        $index = array_search($joke, $ordered, true);
        $neighborIndex = $index + $direction;
        if ($index === false || !isset($ordered[$neighborIndex])) {
            return;
        }

        $neighbor = $ordered[$neighborIndex];
        [$a, $b] = [$joke->getSortOrder(), $neighbor->getSortOrder()];
        $joke->setSortOrder($b);
        $neighbor->setSortOrder($a);
        $this->em->flush();
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
