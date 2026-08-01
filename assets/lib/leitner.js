/*
* Port of ~/sites/anki's UserWord::grade() (src/Entity/Lls/UserWord.php) —
* same box/interval scheme, just running client-side against a Dexie
* `progress` row instead of a Doctrine entity + server round-trip.
*/
export const INTERVALS = { 1: 0, 2: 1, 3: 3, 4: 7, 5: 16 }; // days per box

export function grade(progress, correct) {
    const box = correct ? Math.min(progress.box + 1, 5) : 1;
    const days = INTERVALS[box] ?? 0;
    const dueAt = new Date(Date.now() + days * 86400000).toISOString();

    return { ...progress, box, dueAt };
}
