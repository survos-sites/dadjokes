<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\JokeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

/** Front of the flashcard is $keyword, back is $joke — see review_controller.js in assets/. */
#[ORM\Entity(repositoryClass: JokeRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
    ],
    normalizationContext: ['groups' => ['joke:read']],
    order: ['id' => 'ASC'],
    paginationItemsPerPage: 100,
)]
class Joke
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['joke:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    #[Groups(['joke:read'])]
    private string $keyword;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['joke:read'])]
    private string $joke;

    public function __construct(string $keyword, string $joke)
    {
        $this->keyword = $keyword;
        $this->joke = $joke;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKeyword(): string
    {
        return $this->keyword;
    }

    public function getJoke(): string
    {
        return $this->joke;
    }
}
