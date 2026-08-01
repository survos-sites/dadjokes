<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Joke;
use App\Repository\JokeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

/** Idempotent — skips jokes that already exist by keyword. Safe to re-run. */
#[AsCommand('app:seed-jokes', 'Seed the curated dad-joke deck')]
final class SeedJokesCommand
{
    /** @var list<array{keyword:string,joke:string}> */
    private const JOKES = [
        ['keyword' => 'Scarecrow', 'joke' => 'Why did the scarecrow win an award? He was outstanding in his field.'],
        ['keyword' => 'Bicycle', 'joke' => "I couldn't figure out why the bicycle kept falling over. Then it dawned on me — it was two-tired."],
        ['keyword' => 'Skeleton', 'joke' => "Why don't skeletons fight each other? They don't have the guts."],
        ['keyword' => 'Penguin', 'joke' => 'How does a penguin build its house? Igloos it together.'],
        ['keyword' => 'Time Travel', 'joke' => 'I was going to tell a time-traveling joke, but you guys didn\'t like it.'],
        ['keyword' => 'Noodle', 'joke' => 'What do you call a fake noodle? An impasta.'],
        ['keyword' => 'Alligator', 'joke' => 'What do you call an alligator in a vest? An investigator.'],
        ['keyword' => 'Alphabet', 'joke' => "I only know 25 letters of the alphabet. I don't know y."],
        ['keyword' => 'Can Opener', 'joke' => "What do you call a can opener that doesn't work? A can't opener."],
        ['keyword' => 'Lightning', 'joke' => 'I was struggling to figure out how lightning works, but then it struck me.'],
        ['keyword' => 'Blind Fish', 'joke' => "What do you call a fish with no eyes? A fsh."],
        ['keyword' => 'Six Afraid', 'joke' => "Why was six afraid of seven? Because seven eight nine."],
        ['keyword' => 'Banker', 'joke' => "I used to be a banker, but I lost interest."],
        ['keyword' => 'Nacho Cheese', 'joke' => "What kind of cheese isn't yours? Nacho cheese."],
        ['keyword' => 'Snowman', 'joke' => "What did one snowman say to the other? Do you smell carrots?"],
        ['keyword' => 'Practical Yolker', 'joke' => "What do you call an egg that plays a prank? A practical yolker."],
        ['keyword' => 'Golfer', 'joke' => "Why did the golfer bring two pairs of pants? In case he got a hole in one."],
        ['keyword' => 'Raisin', 'joke' => "What do you call a grape that just sat in the sun? A raisin."],
        ['keyword' => 'Dentist', 'joke' => "Why did the dentist study astronomy? To take a look at the Big Dipper."],
        ['keyword' => 'Bread Pitt', 'joke' => "What do you call a sandwich with no filling? Bread pitt."],
    ];

    public function __construct(
        private readonly JokeRepository $jokes,
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function __invoke(SymfonyStyle $io): int
    {
        $existing = array_flip(array_map(
            static fn (Joke $j): string => $j->getKeyword(),
            $this->jokes->findAll(),
        ));

        $created = 0;
        foreach (self::JOKES as $row) {
            if (isset($existing[$row['keyword']])) {
                continue;
            }
            $this->em->persist(new Joke($row['keyword'], $row['joke']));
            $created++;
        }
        $this->em->flush();

        $io->success(sprintf('%d joke(s) created, %d already present.', $created, count(self::JOKES) - $created));

        return Command::SUCCESS;
    }
}
