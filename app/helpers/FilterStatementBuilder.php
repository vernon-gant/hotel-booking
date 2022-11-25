<?php

class FilterStatementBuilder {

	private string $query;

	private array $args;

	/**
	 * @return string
	 */
	public function getQuery(): string {
		return $this->query;
	}

	/**
	 * @return array
	 */
	public function getArgs(): array {
		return $this->args;
	}

	public function __construct(string $query, array $args) {
		$this->query = $query;
		$this->args = $args;
	}

	private function price(int $from, int $to) : void {
		$this->query .= " AND price >= ? and price < ?";
		array_push($this->args,$from,$to);
	}

	private function floor(int $floor) : void {
		$this->query .= " AND floor = ?";
		$this->args[] = $floor;
	}

	private function pets(int $pets) : void {
		$this->query .= " AND pets_allowed = ?";
		$this->args[] = $pets;
	}

	public function build(array $filters) : self {
		if (isset($filters['floor'])) $this->floor($filters['floor']);
		if (isset($filters['price'])) $this->price($filters['price'][0],$filters['price'][1]);
		if (isset($filters['pets'])) $this->pets($filters['pets']);
		$this->query .= "\nGROUP BY room_type";
		return $this;
	}
}