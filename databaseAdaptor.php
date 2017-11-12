<?php
class DatabaseAdaptor {
	// The instance variable used in every one of the functions in class DatbaseAdaptor
	private $DB;
	// Make a connection to an existing data based named 'first' that has table customer
	public function __construct() {
		$db = 'mysql:dbname=quotes; charset=utf8; host=127.0.0.1';
		$user = 'root';
		$password = '';
		
		try {
			$this->DB = new PDO ( $db, $user, $password );
			$this->DB->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		} catch ( PDOException $e ) {
			echo ('Error establishing Connection');
			exit ();
		}
	}
	
	public function getQuotesAsArray(){
		$stmt = $this->DB->prepare ( "SELECT * FROM quotations ORDER BY rating DESC");
		$stmt->execute ();
		// fetchall returns all records in the set as an array
		return $stmt->fetchAll ( PDO::FETCH_ASSOC );
	}
	
	public function checkNewUser($name){
		$stmt = $this->DB->prepare ( "SELECT * FROM users WHERE username = \"" . $name . "\"");
		$stmt->execute ();
		// fetchall returns all records in the set as an array
		return $stmt->fetchAll ( PDO::FETCH_ASSOC );
	}
	
	public function addNewUser($name, $pass){
		$stmt = $this->DB->prepare ( "insert into users(username, hash) values(\"" . $name . "\", \"" . $pass . "\")");
		$stmt->execute ();
	}
	
	public function flag($quote){
		$stmt = $this->DB->prepare ("update quotations set flagged = 1 where quote = \"" . $quote . "\"");
		$stmt->execute ();
	}
	
	public function unflag(){
		$stmt = $this->DB->prepare ("update quotations set flagged = 0");
		$stmt->execute ();
	}
	
	public function plus($quote){
		$stmt = $this->DB->prepare ("update quotations set rating = rating+1 where quote = \"" . $quote . "\"");
		$stmt->execute ();
	}
	
	public function minus($quote){
		$stmt = $this->DB->prepare ("update quotations set rating = rating-1 where quote = \"" . $quote . "\"");
		$stmt->execute ();
	}
	
	public function addNewQuote($quote, $author){
		$stmt = $this->DB->prepare ( "insert into quotations(added, quote, author, rating, flagged) values(NOW(), \"" . $quote . "\", \"" . $author . "\", 0, 0)");
		$stmt->execute ();
	}
} // End class DatabaseAdaptor

$theDBA = new DatabaseAdaptor ();
// Do not put any other echo, print, or print_r here.

?>