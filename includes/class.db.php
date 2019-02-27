<?php

class Database {

	public $con;	

	public function __construct() {
		
		if($_SERVER['SERVER_NAME'] == 'localhost') {
			$dbhost = 'localhost';
			$dbuser = 'root';
			$dbpass = '';
			$dbname = 'slr';
			$this->con = mysqli_connect ($dbhost, $dbuser, $dbpass, $dbname) or die ('I cannot connect to the database because: ' . mysqli_error());					
		}
		else {
			$dbhost = 'localhost';
			$dbuser = 'client_SLR';
			$dbpass = 'client_SLR';
			$dbname = 'client_SLR';
			$this->con = mysqli_connect ($dbhost, $dbuser, $dbpass, $dbname) or die ('I cannot connect to the database because: ' . mysqli_error());  
		}	
	}
}
?>