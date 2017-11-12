<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Quote</title>

<style>
input{
	margin: 5px;
	float: left;
}
label{
    float: left;
    clear: left;
    width: 70px;
    margin: 5px;
}
form{
	border: 2px solid black;
	height: 100px;
	width: 300px;
	border-radius: 5px;
}
</style>
</head>
<body>
<?php 
session_start();
include 'databaseAdaptor.php'; 
?>
	<h1>Add Quote</h1>

	<form name="loginform" method="post">
    	<label>Quote</label>
    	<input type="text" name="quote"> 
    	<label>Author </label>
    	<input type="text" name="author">
    	<input type="submit" name="addQuote"/>
	</form>
	<?php
		if(isset($_POST['addQuote'])){
			$theDBA = new databaseAdaptor();
			$quote = $_POST['quote'];
			$author = $_POST['author'];
			if($quote == NULL){
				echo "<br>The quote box must be filled in to submit a quote";
				if($author == NULL){
					echo "<br>The author box must be filled in to submit a quote";
				}
			} else {
				if($author == NULL){
					echo "<br>The author box must be filled in to submit a quote";
				} else {
					$theDBA->addNewQuote($quote, $author);
					header("Location: index.php");
				}
			}
		}
			
	?>

</body>
</html>