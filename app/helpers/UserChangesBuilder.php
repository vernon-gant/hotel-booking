<?php

class UserChangesBuilder {

	private string $query;

	private array $args;

	private mixed $baseUser;

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

	public function __construct(mixed $baseUser) {
		$this->query = "UPDATE users
						SET";
		$this->args = array();
		$this->baseUser = $baseUser;
	}

	private function email(string $email) : void {
		$this->query .= " email = ?,";
		$this->args[] = $email;
	}

	private function first_name(string $first_name) : void {
		$this->query .= " first_name = ?,";
		$this->args[] = $first_name;
	}

	private function last_name(string $last_name) : void {
		$this->query .= " last_name = ?,";
		$this->args[] = $last_name;
	}

	private function password(string $password) : void {
		$this->query .= " password = ?";
		$this->args[] = $password;
	}

	private function cleanQuery() : void {
		if (str_ends_with($this->query,","))
			$this->query = substr_replace($this->query,"",-1);
	}

	private function validField(string $name, mixed $value) : bool {
		return $value != null and $value != $this->baseUser->$name;
	}

	public function build(array $fields) : self {
		if ($this->validField("email", $fields['email'])) $this->email($fields['email']);
		if ($this->validField("first_name", $fields['first_name'])) $this->first_name($fields['first_name']);
		if ($this->validField("last_name", $fields['last_name'])) $this->last_name($fields['last_name']);
		if ($this->validField("password", $fields['password'])) $this->password($fields['password']);
		$this->cleanQuery();
		$this->query .= "\nWHERE email = ?";
		$this->args[] = $this->baseUser->email;
		return $this;
	}

}