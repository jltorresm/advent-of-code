<?php

/**
 * --- Part Two ---
 *
 * It seems like there is still quite a bit of duplicate work planned. Instead, the Elves would like to know the number of pairs that overlap at all.
 *
 * In the above example, the first two pairs (2-4,6-8 and 2-3,4-5) don't overlap, while the remaining four pairs (5-7,7-9, 2-8,3-7, 6-6,4-6, and 2-6,4-8) do overlap:
 *
 * - 5-7,7-9 overlaps in a single section, 7.
 * - 2-8,3-7 overlaps all of the sections 3 through 7.
 * - 6-6,4-6 overlaps in a single section, 6.
 * - 2-6,4-8 overlaps in sections 4, 5, and 6.
 *
 * So, in this example, the number of overlapping assignment pairs is 4.
 *
 * In how many assignment pairs do the ranges overlap?
 */


$input = <<<EOL
2-4,6-8
2-3,4-5
5-7,7-9
2-8,3-7
6-6,4-6
2-6,4-8
EOL;

function into_usable(string $raw_input) : array {
	$lines = explode("\n", $raw_input);
	$ranges = array_map(fn($l) => explode(",", $l), $lines);
	$split_ranges = array_map(
		fn($r) => array_map(fn($m) => explode("-", $m), $r),
		$ranges
	);
	return $split_ranges;
}

/**
 * Returns true if $a intersects $b.
 */
function intersects($a, $b) : bool {
	return $a[0] <= $b[1] && $b[0] <= $a[1];
}

function main(string $raw_input) : int {
	$input = into_usable($raw_input);

	$reducer = function(int $carry, $ranges) {
		if (intersects(...$ranges)) {
			$carry++;
		}
		return $carry;
	};

	return array_reduce($input, $reducer, 0);
}

$input = trim(file_get_contents("input"));
echo main($input), PHP_EOL;
