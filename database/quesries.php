<?php 


/**
* Provides methods to query data throughout the app
*/
class QUERY {

	private $DB;
	var $debug = false;

	function __construct($DB) {
		$this->DB = $DB;
	}
		
	public function USERS() {
		
		$sql = "SELECT * FROM users";
		
		return $this->DB->QUERY($sql);
	
	}

	function SURVEYS_CREATED($user_id) {
	
		$sql = "SELECT * FROM surveys WHERE author= :user_id";
		
		return $this->DB->QUERY($sql, ["user_id" => $user_id], $this->debug)->fetchAll();

	}

	function SURVEYS_JOINED($user_id) {
	
		$sql = "SELECT * FROM surveys INNER JOIN survey_participants ON `surveys`.id = `survey_participants`.survey_id WHERE `survey_participants`.user_id = :user_id";
		
		return $this->DB->QUERY($sql, ["user_id" => $user_id], $this->debug)->fetchAll();

	}

	function SURVEY($survey_id) {

		$sql = "SELECT * FROM surveys WHERE id = :survey_id LIMIT 1";

		return $this->DB->QUERY($sql, ["survey_id" => $survey_id], $this->debug)->fetch();

	}

	function SURVEY_PARTICIPANTS($survey_id) {

		$sql = "SELECT * FROM users INNER JOIN survey_participants ON `users`.id = `survey_participants`.user_id WHERE `survey_participants`.survey_id = :survey_id";

		return $this->DB->QUERY($sql, ["survey_id" => $survey_id], $this->debug)->fetchAll();

	}

}