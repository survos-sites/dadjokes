<?php

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Symfony\UX\StimulusBundle\StimulusBundle::class => ['all' => true],
    Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
    Symfony\UX\Icons\UXIconsBundle::class => ['all' => true],
    Symfony\UX\TwigComponent\TwigComponentBundle::class => ['all' => true],
    Survos\AtlasBundle\SurvosAtlasBundle::class => ['all' => true],
    Survos\Kit\SurvosKitBundle::class => ['all' => true],
    SpomkyLabs\PwaBundle\SpomkyLabsPwaBundle::class => ['all' => true],
    Knp\Bundle\MenuBundle\KnpMenuBundle::class => ['all' => true],
    Survos\FwBundle\SurvosFwBundle::class => ['all' => true],
    Survos\JsTwigBundle\SurvosJsTwigBundle::class => ['all' => true],
    Survos\MobileBundle\SurvosMobileBundle::class => ['all' => true],
    Survos\DeploymentBundle\SurvosDeploymentBundle::class => ['dev' => true, 'test' => true],
    ApiPlatform\Symfony\Bundle\ApiPlatformBundle::class => ['all' => true],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
];
