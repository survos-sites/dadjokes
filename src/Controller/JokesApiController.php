<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class JokesApiController
{
    /** @var list<array{id:int,keyword:string,joke:string}> */
    private const JOKES = [
        ['id' => 1, 'keyword' => 'Scarecrow', 'joke' => 'Why did the scarecrow win an award? He was outstanding in his field.'],
        ['id' => 2, 'keyword' => 'Bicycle', 'joke' => "I couldn't figure out why the bicycle kept falling over. Then it dawned on me — it was two-tired."],
        ['id' => 3, 'keyword' => 'Skeleton', 'joke' => "Why don't skeletons fight each other? They don't have the guts."],
        ['id' => 4, 'keyword' => 'Coffee', 'joke' => 'How does a penguin build its house? Igloos it together.'],
        ['id' => 5, 'keyword' => 'Toast', 'joke' => 'I was going to tell a time-traveling joke, but you guys didn\'t like it.'],
        ['id' => 6, 'keyword' => 'Pizza', 'joke' => "What do you call a fake noodle? An impasta."],
        ['id' => 7, 'keyword' => 'Ocean', 'joke' => 'What do you call an alligator in a vest? An investigator.'],
        ['id' => 8, 'keyword' => 'Book', 'joke' => "I only know 25 letters of the alphabet. I don't know y."],
        ['id' => 9, 'keyword' => 'Garden', 'joke' => "What do you call a can opener that doesn't work? A can't opener."],
        ['id' => 10, 'keyword' => 'Battery', 'joke' => 'I was struggling to figure out how lightning works, but then it struck me.'],
        ['id' => 11, 'keyword' => 'Fish', 'joke' => "What do you call a fish with no eyes? A fsh."],
        ['id' => 12, 'keyword' => 'Math', 'joke' => "Why was six afraid of seven? Because seven eight nine."],
        ['id' => 13, 'keyword' => 'Ladder', 'joke' => "I used to be a banker, but I lost interest."],
        ['id' => 14, 'keyword' => 'Cheese', 'joke' => "What kind of cheese isn't yours? Nacho cheese."],
        ['id' => 15, 'keyword' => 'Snow', 'joke' => "What did one snowman say to the other? Do you smell carrots?"],
        ['id' => 16, 'keyword' => 'Egg', 'joke' => "What do you call an egg that plays a prank? A practical yolker."],
        ['id' => 17, 'keyword' => 'Golf', 'joke' => "Why did the golfer bring two pairs of pants? In case he got a hole in one."],
        ['id' => 18, 'keyword' => 'Grape', 'joke' => "What do you call a grape that just sat in the sun? A raisin."],
        ['id' => 19, 'keyword' => 'Dentist', 'joke' => "Why did the dentist study astronomy? To take a look at the Big Dipper."],
        ['id' => 20, 'keyword' => 'Sandwich', 'joke' => "What do you call a sandwich with no filling? Bread pitt."],
    ];

    #[Route('/api/jokes', name: 'api_jokes', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        // DbUtilities::fetchTable() (js-twig-bundle) expects a Hydra-shaped
        // collection: { member: [...], view: { next: <url>|null } }.
        return new JsonResponse([
            'member' => self::JOKES,
            'view' => ['next' => null],
        ]);
    }
}
