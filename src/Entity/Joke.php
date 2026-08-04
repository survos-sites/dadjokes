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
    order: ['ageGroup' => 'DESC', 'sortOrder' => 'ASC'],
    paginationItemsPerPage: 100,
)]
class Joke
{
    /** 'little_kids' or 'big_kids' — some puns need vocabulary/idioms younger campers won't have yet. */
    public const AGE_GROUPS = ['little_kids', 'big_kids'];

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

    /** Deck/set this card belongs to — e.g. "classic", "animals", "food". Lets the app switch sets. */
    #[ORM\Column(length: 32)]
    #[Groups(['joke:read'])]
    private string $category = 'classic';

    #[ORM\Column(length: 16)]
    #[Groups(['joke:read'])]
    private string $ageGroup = 'big_kids';

    /** Manual drag-free reorder via the admin's up/down arrows — tiebreaker within the same rating. */
    #[ORM\Column]
    #[Groups(['joke:read'])]
    private int $sortOrder = 0;

    /** 1-4 stars — how much Tac likes it / how confident he is delivering it live. Drives print + admin order. */
    #[ORM\Column]
    #[Groups(['joke:read'])]
    private int $rating = 3;

    public function __construct(string $keyword, string $joke, string $category = 'classic', string $ageGroup = 'big_kids', int $sortOrder = 0, int $rating = 3)
    {
        $this->keyword = $keyword;
        $this->joke = $joke;
        $this->category = $category;
        $this->ageGroup = $ageGroup;
        $this->sortOrder = $sortOrder;
        $this->rating = $rating;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKeyword(): string
    {
        return $this->keyword;
    }

    public function setKeyword(string $keyword): static
    {
        $this->keyword = $keyword;

        return $this;
    }

    public function getJoke(): string
    {
        return $this->joke;
    }

    public function setJoke(string $joke): static
    {
        $this->joke = $joke;

        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getAgeGroup(): string
    {
        return $this->ageGroup;
    }

    public function setAgeGroup(string $ageGroup): static
    {
        $this->ageGroup = $ageGroup;

        return $this;
    }

    public function getSortOrder(): int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): static
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }
}
