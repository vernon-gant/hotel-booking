<?php

/**
 * User DAO
 */
class User {

	private Database $db;

	public function __construct() {
		$this->db = new Database();
	}

	/**
	 * Checks if the user (use "admin" role for admin) exists in the database
	 * @param $email
	 * @param $role
	 * @return bool
	 */
	public function emailExists($email, $role): bool {
		$this->db->query("SELECT * FROM users WHERE email = ? AND role = ?", $email,$role);
		return $this->db->rowCount() > 0;
	}

	/**
	 * Checks password for a specific user (use "admin" role for admin)
	 * @param string $email
	 * @param string $password
	 * @param $role
	 * @return bool
	 */
	public function correctPassword(string $email, string $password, $role): bool {
		$this->db->query("SELECT * FROM users where email = ? AND password = ? AND role = ?", $email, $password,$role);
		return $this->db->rowCount() > 0;
	}

	/**
	 * Checks if the user account is active
	 * @param string $email
	 * @return bool
	 */
	public function isActive(string $email) : bool {
		$this->db->query("SELECT * FROM users WHERE email = ? AND role = 'User' AND status = 'active'", $email);
		return $this->db->rowCount() > 0;
	}

	/**
	 * Retrieves the user data from the database
	 * @param string $email
	 * @return mixed
	 */
	public function findUser(string $email): mixed {
		$this->db->query("SELECT * FROM users where email = ?", $email);
		return $this->db->singleRow();
	}

	/**
	 * Deletes the user from the database
	 * @param string $email
	 * @return bool
	 */
	public function deleteUser(string $email): bool {
		$this->db->query("delete from motelx.users
							  where email = ?", $email);
		return $this->db->affectedRows() > 0;
	}

	/**
	 * Inserts a new user into the database
	 * @param $data
	 * @return bool
	 */
	public function register($data): bool {
		$this->db->query("INSERT INTO users (email, password, first_name, last_name,role) VALUES (?, ?, ?, ?, ?)",
			$data['email'], $data['pass'],$data['first_name'],$data['last_name'],"User");
		return $this->db->affectedRows() > 0;
	}

	/**
	 * Fetches all users from the database
	 * @return array|null
	 */
	public function fetchUsers() : ?array {
		$this->db->query("SELECT * FROM users WHERE role = 'User'");
		if ($this->db->rowCount() > 0) return $this->db->resultSet();
		else return null;
	}

	/**
	 * Changes the user status to active if was inactive or vice versa
	 * @param string $email
	 * @return bool
	 */
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

	/**
	 * Creates session for the user
	 * @param $user
	 * @param string $role
	 * @return void
	 */
	public function createSession($user, string $role): void {
		$_SESSION[$role . '_email'] = $user->email;
		$_SESSION[$role . '_first_name'] = $user->first_name;
		$_SESSION[$role . '_last_name'] = $user->last_name;
	}

	/**
	 * Forms an array for changeUser method
	 * @return array
	 */
	public function prepareUserEditData(): array {
		return [
			'email' => empty(trim($_POST['email'])) ? null : trim($_POST['email']),
			'first_name' => empty(trim($_POST['first_name'])) ? null : trim($_POST['first_name']),
			'last_name' => empty(trim($_POST['last_name'])) ? null : trim($_POST['last_name']),
			'password' => empty(trim($_POST['pass'])) ? null : sha1(trim($_POST['pass']))
		];
	}

	/**
	 * Method to change user's data either from admin panel or from user's profile
	 * @param mixed $baseUser
	 * @param array $fields
	 * @return bool
	 */
	public function changeUser(mixed $baseUser, array $fields) : bool {
		$changesBuilder = (new UserChangesBuilder($baseUser))->build($fields);
		if (count($changesBuilder->getArgs()) > 1) {
			$this->db->query($changesBuilder->getQuery(),...$changesBuilder->getArgs());
			return $this->db->affectedRows() > 0;
		} else return true;
	}

	/**
	 * Fetches all bookings of a specific user
	 * @return array|null
	 */
	public function fetchBookings(): ?array {
		$this->db->query("SELECT r.res_id,
							         r.room_num,
							         rt.name as room_type,
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
							      	   JOIN rooms ro on r.room_num = ro.room_num
							           JOIN room_types rt on ro.room_type = rt.name
							           JOIN guests g on g.guest_id = r.guest_id
							  WHERE re1.created_at = (SELECT MAX(re2.created_at)
							                         from reservation_events re2
							                         where re1.res_id = re2.res_id)
							  AND r.user_email = ?
							  GROUP BY r.res_id, r.transaction_date
							  order by r.transaction_date desc",$_SESSION['user_email']);
		if ($this->db->rowCount() > 0) return $this->db->resultSet();
		else return null;
	}

	/**
	 * Destroys the session of the user and logs him out
	 * @param string $role
	 * @return void
	 */
	public function logout(string $role): void {
		unset($_SESSION[$role . '_email'], $_SESSION[$role . '_first_name'], $_SESSION[$role . '_last_name']);
		session_destroy();
		redirect("pages/index");
	}
}