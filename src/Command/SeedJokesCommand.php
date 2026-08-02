<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Joke;
use App\Repository\JokeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

/** Idempotent — matches existing jokes by keyword, updates their category, seeds new ones. Safe to re-run. */
#[AsCommand('app:seed-jokes', 'Seed the curated dad-joke deck')]
final class SeedJokesCommand
{
    /** @var list<array{keyword:string,joke:string,category:string}> */
    private const JOKES = [
        ['keyword' => 'Scarecrow', 'joke' => 'Why did the scarecrow win an award? He was outstanding in his field.', 'category' => 'classic'],
        ['keyword' => 'Bicycle', 'joke' => "I couldn't figure out why the bicycle kept falling over. Then it dawned on me — it was two-tired.", 'category' => 'classic'],
        ['keyword' => 'Skeleton', 'joke' => "Why don't skeletons fight each other? They don't have the guts.", 'category' => 'classic'],
        ['keyword' => 'Penguin', 'joke' => 'How does a penguin build its house? Igloos it together.', 'category' => 'animals'],
        ['keyword' => 'Time Travel', 'joke' => 'I was going to tell a time-traveling joke, but you guys didn\'t like it.', 'category' => 'classic'],
        ['keyword' => 'Noodle', 'joke' => 'What do you call a fake noodle? An impasta.', 'category' => 'food'],
        ['keyword' => 'Alligator', 'joke' => 'What do you call an alligator in a vest? An investigator.', 'category' => 'animals'],
        ['keyword' => 'Alphabet', 'joke' => "I only know 25 letters of the alphabet. I don't know y.", 'category' => 'classic'],
        ['keyword' => 'Can Opener', 'joke' => "What do you call a can opener that doesn't work? A can't opener.", 'category' => 'classic'],
        ['keyword' => 'Lightning', 'joke' => 'I was struggling to figure out how lightning works, but then it struck me.', 'category' => 'science'],
        ['keyword' => 'Blind Fish', 'joke' => "What do you call a fish with no eyes? A fsh.", 'category' => 'animals'],
        ['keyword' => 'Six Afraid', 'joke' => "Why was six afraid of seven? Because seven eight nine.", 'category' => 'math'],
        ['keyword' => 'Banker', 'joke' => "I used to be a banker, but I lost interest.", 'category' => 'classic'],
        ['keyword' => 'Nacho Cheese', 'joke' => "What kind of cheese isn't yours? Nacho cheese.", 'category' => 'food'],
        ['keyword' => 'Snowman', 'joke' => "What did one snowman say to the other? Do you smell carrots?", 'category' => 'classic'],
        ['keyword' => 'Practical Yolker', 'joke' => "What do you call an egg that plays a prank? A practical yolker.", 'category' => 'food'],
        ['keyword' => 'Golfer', 'joke' => "Why did the golfer bring two pairs of pants? In case he got a hole in one.", 'category' => 'sports'],
        ['keyword' => 'Raisin', 'joke' => "What do you call a grape that just sat in the sun? A raisin.", 'category' => 'food'],
        ['keyword' => 'Dentist', 'joke' => "Why did the dentist study astronomy? To take a look at the Big Dipper.", 'category' => 'classic'],
        ['keyword' => 'Bread Pitt', 'joke' => "What do you call a sandwich with no filling? Bread pitt.", 'category' => 'food'],
    ];

    public function __construct(
        private readonly JokeRepository $jokes,
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function __invoke(SymfonyStyle $io): int
    {
        $existing = [];
        foreach ($this->jokes->findAll() as $existingJoke) {
            $existing[$existingJoke->getKeyword()] = $existingJoke;
        }

        $created = 0;
        $updated = 0;
        foreach (self::JOKES as $row) {
            $entity = $existing[$row['keyword']] ?? null;
            if ($entity === null) {
                $this->em->persist(new Joke($row['keyword'], $row['joke'], $row['category']));
                $created++;
                continue;
            }
            if ($entity->getCategory() !== $row['category'] || $entity->getJoke() !== $row['joke']) {
                $entity->setJoke($row['joke'])->setCategory($row['category']);
                $updated++;
            }
        }
        $this->em->flush();

        $io->success(sprintf('%d joke(s) created, %d updated, %d unchanged.', $created, $updated, count(self::JOKES) - $created - $updated));

        return Command::SUCCESS;
    }
}
