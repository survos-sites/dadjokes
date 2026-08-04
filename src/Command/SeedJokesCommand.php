<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Joke;
use App\Repository\JokeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Idempotent — matches existing jokes by their joke text (stable), updates
 * keyword/category/ageGroup, seeds new ones. Safe to re-run. Matching on
 * joke text rather than keyword lets the flashcard prompt keep getting
 * tuned (via /admin/jokes or this list) without spawning duplicate rows.
 * sortOrder is only ever set on CREATE — /admin/jokes' up/down arrows own
 * it after that, re-running this command won't reset a curated order.
 */
#[AsCommand('app:seed-jokes', 'Seed the curated dad-joke deck')]
final class SeedJokesCommand
{
    /**
     * ageGroup: 'little_kids' (concrete objects/simple homophones, no idioms
     * or outside knowledge needed) vs 'big_kids' (needs an idiom, abstract
     * concept, or piece of grown-up trivia — golf scoring, bank interest,
     * a celebrity name — to land at all).
     *
     * @var list<array{keyword:string,joke:string,category:string,ageGroup:string}>
     */
    private const JOKES = [
        // --- little kids ---
        ['keyword' => 'Scarecrow / Award', 'joke' => 'Why did the scarecrow win an award? He was outstanding in his field.', 'category' => 'classic', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Bicycle / Two-Tired', 'joke' => "I couldn't figure out why the bicycle kept falling over. Then it dawned on me — it was two-tired.", 'category' => 'classic', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Skeletons Fight / No Guts', 'joke' => "Why don't skeletons fight each other? They don't have the guts.", 'category' => 'classic', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Penguin House / Igloos', 'joke' => 'How does a penguin build its house? Igloos it together.', 'category' => 'animals', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Fake Noodle / Impasta', 'joke' => 'What do you call a fake noodle? An impasta.', 'category' => 'food', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Alligator Vest / Investigator', 'joke' => 'What do you call an alligator in a vest? An investigator.', 'category' => 'animals', 'ageGroup' => 'little_kids'],
        ['keyword' => '25 Letters / Don\'t Know Y', 'joke' => "I only know 25 letters of the alphabet. I don't know y.", 'category' => 'classic', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Broken Can Opener / Can\'t', 'joke' => "What do you call a can opener that doesn't work? A can't opener.", 'category' => 'classic', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Eyeless Fish / Fsh', 'joke' => "What do you call a fish with no eyes? A fsh.", 'category' => 'animals', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Six Afraid / 7-8-9', 'joke' => "Why was six afraid of seven? Because seven eight nine.", 'category' => 'classic', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Sad Math Book / Problems', 'joke' => "Why was the math book sad? It had too many problems.", 'category' => 'classic', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Whose Cheese / Nacho Cheese', 'joke' => "What kind of cheese isn't yours? Nacho cheese.", 'category' => 'food', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Snowman Chat / Smell Carrots', 'joke' => "What did one snowman say to the other? Do you smell carrots?", 'category' => 'classic', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Prank Egg / Yolker', 'joke' => "What do you call an egg that plays a prank? A practical yolker.", 'category' => 'food', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Sunbathed Grape / Raisin', 'joke' => "What do you call a grape that just sat in the sun? A raisin.", 'category' => 'food', 'ageGroup' => 'little_kids'],
        ['keyword' => 'French Fries Photo / Cheese', 'joke' => "What did the French fries say to the camera? Cheese!", 'category' => 'food', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Ocean to Beach / Just Waved', 'joke' => "What did the ocean say to the beach? Nothing, it just waved.", 'category' => 'classic', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Toilet Paper Hill / The Bottom', 'joke' => "Why did the toilet paper roll down the hill? To get to the bottom.", 'category' => 'classic', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Bowtie Fish / Sofishticated', 'joke' => "What do you call a fish wearing a bowtie? Sofishticated.", 'category' => 'animals', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Volcano Love / I Lava You', 'joke' => "What did the volcano say to the other volcano? I lava you.", 'category' => 'classic', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Toothless Bear / Gummy Bear', 'joke' => 'What do you call a bear with no teeth? A gummy bear.', 'category' => 'animals', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Legless Cow / Ground Beef', 'joke' => 'What do you call a cow with no legs? Ground beef.', 'category' => 'animals', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Cookie Doctor / Feeling Crumby', 'joke' => 'Why did the cookie go to the doctor? Because it was feeling crumby.', 'category' => 'food', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Pampered Cow / Spoiled Milk', 'joke' => 'What do you get from a pampered cow? Spoiled milk.', 'category' => 'food', 'ageGroup' => 'little_kids'],

        // --- knock-knock, little kids ---
        ['keyword' => 'Knock Knock / Boo Who', 'joke' => "Knock knock. Who's there? Boo. Boo who? Aww, don't cry, it's just a joke!", 'category' => 'knock-knock', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Knock Knock / Interrupting Cow', 'joke' => "Knock knock. Who's there? Interrupting cow. Interrupting cow wh— MOO!", 'category' => 'knock-knock', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Knock Knock / Orange You Glad', 'joke' => "Knock knock. Who's there? Orange. Orange who? Orange you glad I didn't say banana?", 'category' => 'knock-knock', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Knock Knock / Ice Scream', 'joke' => "Knock knock. Who's there? Ice cream. Ice cream who? Ice cream if you don't let me in!", 'category' => 'knock-knock', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Knock Knock / Tank Who', 'joke' => "Knock knock. Who's there? Tank. Tank who? You're welcome! And thank you all for letting me tell you these jokes!", 'category' => 'knock-knock', 'ageGroup' => 'little_kids'],
        ['keyword' => 'Knock Knock / Bless You', 'joke' => "Knock knock. Who's there? Atch. Atch who? Bless you!", 'category' => 'knock-knock', 'ageGroup' => 'little_kids'],

        // --- big kids (need an idiom / abstract concept / grown-up trivia to land) ---
        ['keyword' => 'Time-Travel Joke / Didn\'t Like', 'joke' => 'I was going to tell a time-traveling joke, but you guys didn\'t like it.', 'category' => 'classic', 'ageGroup' => 'big_kids'],
        ['keyword' => 'Lightning / Struck Me', 'joke' => 'I was struggling to figure out how lightning works, but then it struck me.', 'category' => 'classic', 'ageGroup' => 'big_kids'],
        ['keyword' => 'Ex-Banker / Lost Interest', 'joke' => "I used to be a banker, but I lost interest.", 'category' => 'classic', 'ageGroup' => 'big_kids'],
        ['keyword' => 'Golfer Two Pants / Hole in One', 'joke' => "Why did the golfer bring two pairs of pants? In case he got a hole in one.", 'category' => 'sports', 'ageGroup' => 'big_kids'],
        ['keyword' => 'Dentist Astronomy / Big Dipper', 'joke' => "Why did the dentist study astronomy? To take a look at the Big Dipper.", 'category' => 'classic', 'ageGroup' => 'big_kids'],
        ['keyword' => 'No-Filling Sandwich / Bread Pitt', 'joke' => "What do you call a sandwich with no filling? Bread pitt.", 'category' => 'food', 'ageGroup' => 'big_kids'],
        ['keyword' => 'Diarrhea / Runs in Jeans', 'joke' => "Diarrhea is hereditary. It runs in your jeans.", 'category' => 'classic', 'ageGroup' => 'big_kids'],
        ['keyword' => 'Oysters Sharing / Shellfish', 'joke' => "Why don't oysters share? Because they're shellfish.", 'category' => 'animals', 'ageGroup' => 'big_kids'],
        ['keyword' => 'Blushing Tomato / Dressing', 'joke' => "Why did the tomato turn red? Because it saw the salad dressing.", 'category' => 'food', 'ageGroup' => 'big_kids'],
        ['keyword' => 'Anti-Gravity Book / Put Down', 'joke' => "I'm reading a book about anti-gravity. It's impossible to put down.", 'category' => 'classic', 'ageGroup' => 'big_kids'],
        ['keyword' => 'Elevator First Time / Uplifting', 'joke' => "My first time using an elevator was an uplifting experience. The second time let me down.", 'category' => 'classic', 'ageGroup' => 'big_kids'],
        ['keyword' => 'Embrace Mistakes / A Hug', 'joke' => "I told my wife she should embrace her mistakes. She gave me a hug.", 'category' => 'classic', 'ageGroup' => 'big_kids'],
        ['keyword' => 'Termite Bar / Bar Tender', 'joke' => "A termite walks into a bar and asks, is the bar tender here?", 'category' => 'animals', 'ageGroup' => 'big_kids'],

        // --- knock-knock, big kids ---
        ['keyword' => 'Knock Knock / Alaska', 'joke' => "Knock knock. Who's there? Alaska. Alaska who? Alaska one more time, are you ready to go?", 'category' => 'knock-knock', 'ageGroup' => 'big_kids'],
        ['keyword' => 'Knock Knock / Wooden Shoe', 'joke' => "Knock knock. Who's there? Wooden shoe. Wooden shoe who? Wooden shoe like to know!", 'category' => 'knock-knock', 'ageGroup' => 'big_kids'],
        ['keyword' => 'Knock Knock / Cashew', 'joke' => "Knock knock. Who's there? Cash. Cash who? No thanks, I prefer peanuts!", 'category' => 'knock-knock', 'ageGroup' => 'big_kids'],
    ];

    public function __construct(
        private readonly JokeRepository $jokes,
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function __invoke(SymfonyStyle $io): int
    {
        $existing = [];
        $maxSortOrder = 0;
        foreach ($this->jokes->findAll() as $existingJoke) {
            $existing[$existingJoke->getJoke()] = $existingJoke;
            $maxSortOrder = max($maxSortOrder, $existingJoke->getSortOrder());
        }

        $created = 0;
        $updated = 0;
        foreach (self::JOKES as $row) {
            $entity = $existing[$row['joke']] ?? null;
            if ($entity === null) {
                $this->em->persist(new Joke($row['keyword'], $row['joke'], $row['category'], $row['ageGroup'], ++$maxSortOrder));
                $created++;
                continue;
            }
            if ($entity->getCategory() !== $row['category'] || $entity->getKeyword() !== $row['keyword'] || $entity->getAgeGroup() !== $row['ageGroup']) {
                $entity->setKeyword($row['keyword'])->setCategory($row['category'])->setAgeGroup($row['ageGroup']);
                $updated++;
            }
        }
        $this->em->flush();

        $io->success(sprintf('%d joke(s) created, %d updated, %d unchanged.', $created, $updated, count(self::JOKES) - $created - $updated));

        return Command::SUCCESS;
    }
}
