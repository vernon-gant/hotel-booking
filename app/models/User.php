<?php

class User {

	private Database $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function emailExists($email,$role): bool {
		$this->db->query("SELECT * FROM users WHERE email = ? AND role = ?", $email,$role);
		return $this->db->rowCount() > 0;
	}

	public function correctPassword(string $email, string $password,$role): bool {
		$this->db->query("SELECT * FROM users where email = ? AND password = ? AND role = ?", $email, $password,$role);
		return $this->db->rowCount() > 0;
	}

	public function isActive(string $email) : bool {
		$this->db->query("SELECT * FROM users WHERE email = ? AND role = 'User' AND status = 'active'", $email);
		return $this->db->rowCount() > 0;
	}

	public function findUser(string $email): mixed {
		$this->db->query("SELECT * FROM users where email = ?", $email);
		return $this->db->singleRow();
	}

	public function deleteUser(string $email): mixed {
		$this->db->query("delete from motelx.users
							  where email = ?", $email);
		return $this->db->affectedRows() > 0;
	}

	public function register($data): bool {
		$this->db->query("INSERT INTO users (email, password, first_name, last_name,role) VALUES (?, ?, ?, ?, ?)",
			$data['email'], $data['pass'],$data['first_name'],$data['last_name'],"User");
		return $this->db->affectedRows() > 0;
	}

	public function fetchUsers() : ?array {
		$this->db->query("SELECT * FROM users WHERE role = 'User'");
		if ($this->db->rowCount() > 0) return $this->db->resultSet();
		else return null;
	}

	public function changeStatus(string $email) : bool {
		$user = $this->findUser($email);
		$query = match ($user->status) {
			'active' => "update users
						 set status = 'inactive' 
                         where email = ?",
			default => 	"update users
						 set status = 'active'
                         where email = ?"

		};
		$this->db->query($query,$email);
		return $this->db->affectedRows() > 0;
	}

	public function createSession($user,string $role): void {
		$_SESSION[$role . '_email'] = $user->email;
		$_SESSION[$role . '_first_name'] = $user->first_name;
		$_SESSION[$role . '_last_name'] = $user->last_name;
	}

	public function changeUser(mixed $baseUser,array $fields) : bool {
		$changesBuilder = (new UserChangesBuilder($baseUser))->build($fields);
		if (count($changesBuilder->getArgs()) > 1) {
			$this->db->query($changesBuilder->getQuery(),...$changesBuilder->getArgs());
			return $this->db->affectedRows() > 0;
		} else return true;
	}

	public function fetchBookings(): ?array {
		$this->db->query("SELECT r.res_id,
							         r.user_email,
							         g.first_name,
							         g.last_name,
							         g.address,
							         g.city,
							         g.phone,
							         r.room_num,
							         r.guests,
							         r.arrival,
							         r.departure,
							         r.transaction_date,
							         re1.status,
							         r.total_price,
							         GROUP_CONCAT(service_name) as services
							  FROM reservations r
							           JOIN reservation_events re1 on r.res_id = re1.res_id
							           JOIN reservation_services rs on r.res_id = rs.res_id
							           JOIN guests g on g.guest_id = r.guest_id
							  WHERE re1.created_at = (SELECT MAX(re2.created_at)
							                         from reservation_events re2
							                         where re1.res_id = re2.res_id)
							  AND r.user_email = ?
							  GROUP BY r.res_id, r.transaction_date
							  order by r.transaction_date",$_SESSION['user_email']);
		if ($this->db->rowCount() > 0) return $this->db->resultSet();
		else return null;
	}

	public function logout(string $role): void {
		unset($_SESSION[$role . '_email'], $_SESSION[$role . '_first_name'], $_SESSION[$role . '_last_name']);
		session_destroy();
		redirect("pages/index");
	}
}