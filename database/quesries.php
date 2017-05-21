<?php 


/**
* Provides methods to query data throughout the app
*/
class QUERY {

	private $DB;

	function __construct($DB) {
		$this->DB = $DB;
	}
		
	public function USERS() {
		
		$sql = "SELECT * FROM users";
		
		return $this->DB->QUERY($sql);
	
	}

	public function USER_CREATED_SURVEYS($user_id) {
	
		$sql = "SELECT * FROM surveys WHERE author= :user_id";
		
		return $this->DB->QUERY($sql, ["user_id" => $user_id])->fetchAll();

	}

	public function USER_JOINED_SURVEYS($user_id) {
	
		$sql = "SELECT * FROM surveys INNER JOIN survey_participants ON `surveys`.id = `survey_participants`.survey_id WHERE `survey_participants`.user_id = :user_id";
		
		return $this->DB->QUERY($sql, ["user_id" => $user_id])->fetchAll();

	}

}