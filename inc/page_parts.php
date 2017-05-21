<?php 

/**
* Helps create the shared parts of all pages
*/

class PAGE {
	
	public static function HEADER($page_title) {
		
		global $QUERY;
		global $DB;

		require_once "header.php";
	}

	public static function title($title) {
		
	}
	
	public static function FOOTER() {
		
		require_once "footer.php";

	}
}
