<?php
// var_dump (md5('unicefXmasAdmin'));
// $texts = array(
// 	' vegetAri8n a',
// 	'pes',
// 	'hokej', 
// 	'HOKej',
// 	'vychod',
// 	'zapad',
// 	'vegetarian', 
// 	'MASOZRUT'
// );

// $_POST = array(
// 	'access_token' => 'f5577b5e051f6840743852eba9be4999',
// 	'sms_content'  => ' vegetAri8n a'
// );

// $_POST['sms_content'] = $texts[rand(0, 7)];

require_once('db.php');

class Voter extends DB {
	private $accessToken = 'f5577b5e051f6840743852eba9be4999';
	
	public function getSubGroups($devoweled = FALSE) {
		$subgroups = array();
		$result = $this->db->query("SELECT `id`, `code` FROM `subgroups`");
		foreach ($result->fetchAll() as $row) {
			$subgroups[$row['id']] = ($devoweled) ? $this->devowel($row['code']) : $row['code'];
		}

		return $subgroups;
	}

	private function devowel($text) {
		$text = mb_strtolower($text);
		$from = array('á', 'ä', 'č', 'ď', 'é', 'ě', 'í', 'ĺ', 'ľ', 'ň', 'ń', 'ó', 'ô', 'ŕ', 'ř', 'š', 'ť', 'ú', 'ů', 'ý', 'ž');
		$to   = array('a', 'a', 'c', 'd', 'e', 'e', 'i', 'l', 'l', 'n', 'n', 'o', 'o', 'r', 'r', 's', 't', 'u', 'u', 'y', 'z');
		$text = str_replace($from, $to, $text);
		$text = preg_replace('/[aeiouy]/', '', $text);

		return $text;
	}

	private function denumerize($text) {
		return preg_replace('/\d/', '', $text);
	}

	private function depunct($text) {
		return preg_replace('/\W/', '', $text);
	}

	private function compare($text) {
		if (!strlen($text))
			return 0;

		$text = preg_replace('/\s+/', ' ', trim($text));
		$spos = strpos($text, ' ');
		if ($spos !== FALSE)
			$text = substr(trim($text), 0, $spos);


		preg_match('/^(.+)\s?/', $text, $match);
		if (!count($match) || !isset($match[1]))
			return 0;


		$code      = $this->devowel($match[1]);
		$code      = $this->depunct($code);
		$code      = $this->denumerize($code);
		$subgroups = $this->getSubGroups(TRUE);
		
		if (in_array($code, $subgroups))
			return array_search($code, $subgroups);

		return 0;
	}

	public function vote($data) {
		$result = FALSE;

		if (!(isset($data['access_token']) && isset($data['sms_content']) && isset($data['sms_id']))) {
			echo 'ERROR - Some data in URL query are missing. Check for access_token, sms_id and sms_content.';
			return $result;
		}

		if ($this->accessToken == $data['access_token']) {
			$subgroupId = $this->compare($data['sms_content']);
			$smsId      = SQLite3::escapeString($data['sms_id']);
			$smsText    = SQLite3::escapeString($data['sms_content']);
			$exists     = $this->db->query("SELECT `id` FROM `votes` WHERE sms_id = '" . $smsId . "'")->fetch();

			if (!is_array($exists) || !count($exists)) {
				$result = $this->db->exec("INSERT INTO votes (`subgroups_id`, `sms_id`, `text`, `created`) VALUES ('" . $subgroupId . "', '" . $smsId . "', '" . $smsText . "', '" . time() . "') ");
			}
			else {
				echo 'ERROR - SMS already exists.';
				return $result;
			}
		}

		echo ($result) ? 'OK' : 'ERROR - SMS could not be saved.';
		return $result;
	}

	public function getVotes($print = FALSE) {
		$groups    = array();
		$subgroups = array();
		$voteCount = array_fill(0, 14, 0);
		
		$result = $this->db->query("SELECT * FROM `groups`");
		foreach ($result->fetchAll() as $row)
			$groups[$row['id']] = $row['name'];

		$result = $this->db->query("SELECT * FROM `subgroups`");
		foreach ($result->fetchAll() as $row)
			$subgroups[$row['id']] = array('name' => $row['name'], 'parent' => $row['groups_id']);

		$result = $this->db->query("SELECT `subgroups_id` AS `id`, COUNT(`subgroups_id`) AS `cnt` FROM votes GROUP BY `subgroups_id`");
		foreach ($result->fetchAll() as $row) {
			$voteCount[$row['id']] = intval($row['cnt']);
		}

		$votes = array();
		foreach ($groups as $gid => $gname) {
			$subgroup = array('raised' => '');

			foreach ($subgroups as $sid => $sgData) {
				if ($gid == $sgData['parent'])
					$subgroup[$sgData['name']] = $voteCount[$sid];
			}

			$votes[$gname] = $subgroup;
		}

		$jsoned = json_encode($votes);

		if ($print)
			echo $jsoned;

		return $jsoned;
	}

	public function getUncategorised() {
		$result = $this->db->query("SELECT * FROM `votes` WHERE `subgroups_id` = 0 ORDER BY `created` ASC")->fetchAll();
		$msgs = array();
		foreach ($result as $key => $row) {
			$msgs[] = array(
				'id'      => $row['id'],
				'text'    => $row['text'],
				'created' => $row['created']
			);
		}
		return $msgs;
	}
}


global $queries;
$voter = new Voter;

$parsedUrl = parse_url($_SERVER["REQUEST_URI"]);
$paths = explode('/', $parsedUrl['path']);
array_shift($paths);

switch ($paths[0]) {
	case 'vote': 
		if (count($queries)) {
			$voter->vote($queries);
		}
		break;
	
	case 'votes':
		$voter->getVotes(TRUE);
		break;

	default: break;
}