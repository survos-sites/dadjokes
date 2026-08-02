<?php

declare(strict_types=1);

namespace App\Controller;

use Survos\FwBundle\Service\FwService;
use Survos\MobileBundle\Attribute\MobilePage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AppController extends AbstractController
{
    public function __construct(
        private readonly FwService $fwService,
    ) {
    }

    #[Route('/', name: 'app_start')]
    public function start(): Response
    {
        return $this->render('start.html.twig', $this->shellContext());
    }

    #[Route('/pages/review', name: 'app_review')]
    #[MobilePage(title: 'Review', icon: 'tabler:cards', tab: 'study')]
    public function review(): Response
    {
        return $this->render('pages/review.html.twig', $this->shellContext());
    }

    #[Route('/pages/cards', name: 'app_cards')]
    #[MobilePage(title: 'Cards', icon: 'tabler:list', tab: 'cards')]
    public function cards(): Response
    {
        return $this->render('pages/cards.html.twig', $this->shellContext());
    }

    #[Route('/pages/settings', name: 'app_settings')]
    #[MobilePage(title: 'Settings', icon: 'tabler:settings', tab: 'settings')]
    public function settings(): Response
    {
        return $this->render('pages/settings.html.twig', $this->shellContext());
    }

    /** @return array<string, mixed> */
    private function shellContext(): array
    {
        return [
            'fwConfig' => $this->fwService->getConfig(),
        ];
    }
}
