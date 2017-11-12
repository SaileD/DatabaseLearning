<?php
include 'databaseAdaptor.php';

$n = $_GET ['n'];
// $n = "getQuotes";
$arr = [];
if ($n === "getQuotes") {
	$arr = $theDBA->getQuotesAsArray ( );
} else if($n === "unflag"){
	$theDBA->unflag();
} else if($n === "flag"){
	$quote = $_GET['quote'];
	$theDBA->flag($quote);
} else if($n === "plus"){
	$quote = $_GET['quote'];
	$theDBA->plus($quote);
} else if($n === "minus"){
	$quote = $_GET['quote'];
	$theDBA->minus($quote);
} else if($n === "checkNewUser"){
	$name = $_GET['name'];
	$arr = $theDBA->checkNewUser($name);
} else if($n === "addNewUser"){
	$name = $_GET['name'];
	$pass = $_GET['password'];
	$arr = $theDBA->addNewUser($name, $pass);
} else if($n === "addNewQuote"){
	$quote = $_GET['quote'];
	$author = $_GET['author'];
	$arr = $theDBA->addNewQuote($quote, $author);
}

echo json_encode ( $arr );
?>