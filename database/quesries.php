<?php 


/**
* Provides methods to query data throughout the app
* 
* @return : an array of rows returned by the database. Each row is an object.
*/
class QUERY {

	private $DB;
	var $debug = false;

	function __construct($DB) {
		$this->DB = $DB;
	}
	
	/**
	*	Queries all users!
	*/
	public function USERS() {
		
		$sql = "SELECT * FROM users";
		
		$result = $this->DB->QUERY($sql);
		
		return $result;
	}

	/**
	*	Queries surveys created by the passed user id!
	*	 
	*	@param $user_id (string or int) : The user id to get their surveys.
	*/
	function SURVEYS_CREATED($user_id) {
	
		$sql = "SELECT * FROM surveys WHERE author= :user_id";
		
		$paramsToBind = ["user_id" => $user_id];

		$result = $this->DB->QUERY($sql, $paramsToBind, $this->debug)->fetchAll();
		
		return $result;
	}

	/**
	*	Queries surveys joined by the passed user id!
	*	 
	*	@param $user_id (string or int) : The user id to get surveys they're joined.
	*/
	function SURVEYS_JOINED($user_id) {
	
		$sql = "SELECT * FROM surveys INNER JOIN survey_participants ON `surveys`.id = `survey_participants`.survey_id WHERE `survey_participants`.user_id = :user_id";
		
		$paramsToBind = ["user_id" => $user_id];

		$result = $this->DB->QUERY($sql, $paramsToBind, $this->debug)->fetchAll();
		
		return $result;
	}

	/**
	*	Queries a survey using the passed survey id!
	*	 
	*	@param $survey_id (string or int) : The survey id.
	*/
	function SURVEY($survey_id) {

		$sql = "SELECT * FROM surveys WHERE id = :survey_id LIMIT 1";

		$paramsToBind = ["survey_id" => $survey_id];

		$result = $this->DB->QUERY($sql, $paramsToBind, $this->debug)->fetch();
		
		return $result;
	}

	/**
	*	Queries the participants of a survey.
	*	 
	*	@param $survey_id (string or int) : The survey id.
	*/
	function SURVEY_PARTICIPANTS($survey_id) {

		$sql = "SELECT * FROM users INNER JOIN survey_participants ON `users`.id = `survey_participants`.user_id WHERE `survey_participants`.survey_id = :survey_id";

		$paramsToBind = ["survey_id" => $survey_id];

		$result = $this->DB->QUERY($sql, $paramsToBind, $this->debug)->fetchAll();
		
		return $result;
	}

	/**
	*	Queries the answers of a survey.
	*	 
	*	@param $survey_id 	(string or int) : The survey id.
	*	@param $reviewer_id (string or int) : The id of the reviewer user.
	*	@param $reviewee_id	(string or int) : The id of the user being reviewed.
	*/
	function ANSWERS($survey_id, $reviewer_id, $reviewee_id, $status = false) {

		$statusClause = ($status) ? "status = '$status'" : "1";

		$sql = "SELECT * FROM answers WHERE survey_id = :survey_id AND reviewer_id = :reviewer_id AND reviewee_id = :reviewee_id AND $statusClause";

		$paramsToBind = [
			"survey_id" 	=> $survey_id,
			"reviewer_id" 	=> $reviewer_id,
			"reviewee_id"	=> $reviewee_id
		];

		$result = $this->DB->QUERY($sql, $paramsToBind, $this->debug)->fetchAll();
		
		return $result;
	}

	function QUESTIONAIRRE_STATUS($survey_id, $reviewer_id, $reviewee_id) {

		$answers = $this->ANSWERS($survey_id, $reviewer_id, $reviewee_id);

		$status = "published";

		if ($answers && $answers) {

			foreach ($answers as $answer) {
				
				if($answer->status == "flagged") {
					$status = "flagged";
					break; // once we find a flag then we break;
				
				} else if ($answer->status == "draft") {
					$status = "draft";
				}
			}

		} else {
			$status = null;
		}

		return $status;
	}

	

}