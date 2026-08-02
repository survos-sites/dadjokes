import { createEmptyCard, fsrs, generatorParameters, Rating } from 'ts-fsrs';

/*
* Port of the review scheduler from Leitner boxes to FSRS — see
* https://github.com/open-spaced-repetition/ts-fsrs (MIT). Same algorithm
* ~/sites/anki's roadmap already wants ("use FSRS rather than re-implement
* SM-2"), and what flashcards-open-source-app uses for real.
*/
export { Rating };

/** A fresh FSRS card state for a joke that has never been reviewed. */
export function emptyCard() {
    return createEmptyCard();
}

/**
 * Grade a review (Rating.Again/Hard/Good/Easy) and return the rescheduled
 * card. desiredRetention (0-1, from the Settings page) is read fresh each
 * call rather than cached in a module-level scheduler, since the user can
 * change it at any time and scheduler construction is cheap.
 */
export function grade(card, rating, desiredRetention = 0.9) {
    const scheduler = fsrs(generatorParameters({ enable_fuzz: true, request_retention: desiredRetention }));
    return scheduler.next(card, new Date(), rating).card;
}
