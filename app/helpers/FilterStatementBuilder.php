<?php

/**
 * Class FilterStatementBuilder
 * Builds filter statement query from checkbox values
 * on room search page
 */
class FilterStatementBuilder {

	/**
	 * Represents final SQL statement
	 * @var string
	 */
	private string $query;

	/**
	 * Represents parameters for SQL statement
	 * @var array
	 */
	private array $args;

	public function getQuery(): string {
		return $this->query;
	}

	public function getArgs(): array {
		return $this->args;
	}

	public function __construct(string $query, array $args) {
		$this->query = $query;
		$this->args = $args;
	}

	/**
	 * Function to add price filter to query
	 * and return new FilterStatementBuilder object
	 * @param int $from
	 * @param int $to
	 * @return void
	 */
	private function price(int $from, int $to): void {
		$this->query .= " AND price >= ? and price < ?";
		array_push($this->args, $from, $to);
	}

	/**
	 * Function to add floor filter to query
	 * and return new FilterStatementBuilder object
	 * @param int $floor
	 * @return void
	 */
	private function floor(int $floor): void {
		$this->query .= " AND floor = ?";
		$this->args[] = $floor;
	}

	/**
	 * Function to add pets filter to query
	 * and return new FilterStatementBuilder object
	 * @param int $pets
	 * @return void
	 */
	private function pets(int $pets): void {
		$this->query .= " AND pets_allowed = ?";
		$this->args[] = $pets;
	}

	/**
	 * Core engine of FilterStatementBuilder
	 * Takes array of filters and builds query of them
	 * @param array $filters
	 * @return $this
	 */
	public function build(array $filters): self {
		if (isset($filters['floor']))
			$this->floor($filters['floor']);
		if (isset($filters['price']))
			$this->price($filters['price'][0], $filters['price'][1]);
		if (isset($filters['pets']))
			$this->pets($filters['pets']);
		$this->query .= "\nGROUP BY room_type";
		return $this;
	}
}