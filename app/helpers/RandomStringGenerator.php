<?php

/**
 * Class for generating random strings
 * Used for generating ids for post and bookings
 */
class RandomStringGenerator
{
	/**
	 * Allowed characters for the random string
	 * @var string
	 */
	protected string $alphabet;

	/**
	 * Length of the random string
	 * @var int
	 */
	protected int $alphabetLength;


	/**
	 * @param string $alphabet
	 */
	public function __construct(string $alphabet = '')
	{
		if ('' !== $alphabet) {
			$this->setAlphabet($alphabet);
		} else {
			$this->setAlphabet(
				implode(range('A', 'Z'))
				. implode(range(0, 9))
			);
		}
	}

	/**
	 * Define the allowed characters for the random string
	 * @param string $alphabet
	 */
	public function setAlphabet(string $alphabet): void {
		$this->alphabet = $alphabet;
		$this->alphabetLength = strlen($alphabet);
	}

	/**
	 * Function for generating a random string
	 * Loop length times and pick a random character from the alphabet
	 * @param int $length
	 * @return string
	 */
	public function generate(int $length): string {
		$token = '';

		for ($i = 0; $i < $length; $i++) {
			$randomKey = $this->getRandomInteger(0, $this->alphabetLength);
			$token .= $this->alphabet[$randomKey];
		}

		return $token;
	}

	/**
	 * Function for generating a random integer using bits shifting
	 * @param int $min
	 * @param int $max
	 * @return int
	 */
	protected function getRandomInteger(int $min, int $max): int {
		$range = ($max - $min);

		if ($range < 0) {
			// Not so random...
			return $min;
		}

		$log = log($range, 2);

		// Length in bytes.
		$bytes = (int) ($log / 8) + 1;

		// Length in bits.
		$bits = (int) $log + 1;

		// Set all lower bits to 1.
		$filter = (int) (1 << $bits) - 1;

		do {
			$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));

			// Discard irrelevant bits.
			$rnd = $rnd & $filter;

		} while ($rnd >= $range);

		return ($min + $rnd);
	}
}