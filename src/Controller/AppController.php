<?php

declare(strict_types=1);

namespace App\Controller;

use Survos\FwBundle\Service\FwService;
use Survos\MobileBundle\Attribute\MobilePage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class AppController extends AbstractController
{
    public function __construct(
        private readonly FwService $fwService,
    ) {
    }

    /**
     * The marketing/landing page (per Tac, 2026-08-02) -- same pattern as pgsc's
     * landing.html.twig and rutado's HomeController::homepage(): a phone-mock iframe of the real
     * live app plus a QR code linking to the same URL, so a desktop visitor can hand the app
     * straight to their own phone instead of using it inside a browser chrome. Kept at '/' with
     * the app itself moved to /app (route NAME 'app_start' unchanged) so an already-installed
     * PWA's start_url -- config/packages/pwa.yaml resolves it by route name, not a hardcoded path
     * -- keeps launching straight into the app, bypassing this page entirely, which is the
     * correct behavior for an already-installed icon.
     */
    #[Route('/', name: 'app_homepage')]
    public function homepage(): Response
    {
        return $this->render('home/index.html.twig', [
            'appUrl' => $this->generateUrl('app_start', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);
    }

    #[Route('/app', name: 'app_start')]
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
