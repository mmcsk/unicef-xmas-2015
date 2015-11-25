<?php
require_once('db.php');

session_start();

class Administrator extends DB {
	private $logged = FALSE;
	private $salt = 'PackMyBoxWithFiveDozenLiquorJugs_0123456789';


	public $alerts = array();

	public function login($post) {
		if (!isset($post['email']) || !isset($post['password'])) {
			$this->alert('Login unsuccesfull', 4);
			return;
		}

		$user = SQLite3::escapeString($post['email']);
		$pass = SQLite3::escapeString(md5($post['password']));

		$result = $this->db->query("SELECT * FROM `users` WHERE `email` = '" . $user . "' AND `password` = '" . $pass . "'")->fetch();

		if (empty($result)) {
			$this->alert('Username or password is incorrect', 4);
			return;
		}

		$salt = $this->getSalt();

		$_SESSION['user'] = array(
			'email'        => $result['email'],
			'access_token' => $salt
		);

		setcookie('uat', $salt, $this->loginDuration(), '/');

		session_regenerate_id(TRUE);

		$this->db->exec("UPDATE `users` SET `access_token`= '" . $salt . "' WHERE `id` = '" . $result['id'] . "'");
		$this->logged = TRUE;
		$this->alert('Logged in as, ' . $result['email'] . '.', 1);

		header("Location: /admin");
	}

	private function loginDuration($value = 0) {
		return ($value) ? $value : time() + 3600 * 24 * 31;
	}

	public function shadowLogin() {
		$this->logged = FALSE;
		$at           = '';

		if (isset($_SESSION['user'])) {
			setcookie('uat', $_SESSION['user']['access_token'], $this->loginDuration(), '/');
			$at = $_SESSION['user']['access_token'];
		}
		elseif (isset($_COOKIE['uat'])) {
			$at = $_COOKIE['uat'];
		}

		if (strlen($at)) {
			$result       = $this->db->query("SELECT * FROM `users` WHERE access_token = '" . $at . "'")->fetch();
			$this->logged = (!empty($result));
		}

		return $this->logged;
	}

	private function getSalt($length = 5) {
		$salt = '';
		$saltLength = strlen($this->salt) - 1;
		
		for ($i = 0; $i < $length; $i++) {
			$pos = rand(0, $saltLength);
			$salt .= substr($this->salt, $pos, 1);
		}

		$salt = md5($salt . time());

		return $salt;
	}

	public function logout() {
		unset($_SESSION['user']);
		setcookie('uat', '', time() - 1, '/');
		header("Location: /admin");
		// http_redirect('admin.php');
	}

	public function isLogged() {
		return $this->logged;
	}

	public function alert($text, $type = 0) {
		switch ($type) {
			case 1: $sc = 'alert-success'; break;
			case 2: $sc = 'alert-info'; break;
			case 3: $sc = 'alert-warning'; break;
			case 4: $sc = 'alert-danger'; break;
			default: $sc = 'hidden'; break;
		}

		$this->alerts[] = array(
			'class'   => $sc,
			'message' => $text
		);
	}

	public function saveVote($post) {
		$id = SQLite3::escapeString($post['vote_id']);
		$sgId = SQLite3::escapeString($post['assign_to']);

		$result = $this->db->exec("UPDATE `votes` SET `subgroups_id` = '" . $sgId . "' WHERE `id` = '" . $id . "'");

		echo json_encode(array('status' => $result));
		die();
	}

	public function getAlert() {
		return $this->alerts;
	}
}

$admin = new Administrator;

if (isset($paths[1])) {
	switch ($paths[1]) {
		case 'logout': 
			$admin->logout();
			break;

		case 'save-vote':
			$admin->saveVote($_POST);
			break;
	}
}

if (isset($paths[1]) && $paths[1] == 'logout') {
	$admin->logout();
}

if (isset($_POST['login'])) {
	$admin->login($_POST);
}
else {
	$admin->shadowLogin();
}

require_once('voter.php');
$subgroups = $voter->getSubGroups();

$messages = $voter->getUncategorised();

foreach ($messages as $k => $msg) {
	$messages[$k]['time'] = date('Y-m-d H:i:s', $msg['created']);
	// var_dump (strlen($msg['text']));
	if (!strlen($msg['text']))
		$messages[$k]['text'] = '<span class="table__sms--empty">(prázdna SMS)</span>';
}
