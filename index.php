<!DOCTYPE html>
<html>
<head>
<?php session_start();?>
<meta charset="UTF-8">
<title>Quotes</title>
<style>
h1{
	text-align: center;
}

.quote{
	border: 2px solid blue;
	margin: 20px;
	width: 90%;
	height: 10%;
	border-radius: 5px;
}

.buttons{
	margin: 5px;
}

.top{
	float: left;
	margin: 5px;
	background-color: grey;
	color: white;
	align: center;
}

</style>
</head>
<body>
<h1>Quotes</h1>
<input type="button" onclick="location.href='register.php';" value="Register" class="top">
<input type="button" onclick="location.href='login.php';" value="Login" class="top">
<input type="button" onclick="location.href='addQuote.php';" value="Add Quote" class="top">
<?php
	if(isset($_SESSION['user'])){
		echo "<br><br><button onclick=\"unflag()\" class=\"top\">Unflag All</button>";
		echo "<form name=\"logout\" method=\"post\"><input name=\"logout\" type=\"submit\" value=\"Log Out\"  class=\"top\"></form>";
	}
?>
<br><br>

<div id="toChange">

</div>

<?php
	
?>

<script>
	window.onload = populate;
	var array = [];
	function populate(){
		var anObj = new XMLHttpRequest();
		anObj.open("GET", "controller.php?n=getQuotes", true);
		anObj.send();
	
		anObj.onreadystatechange = function() {
			if (anObj.readyState == 4 && anObj.status == 200) {
				array = JSON.parse(anObj.responseText);
	
				console.log(array);
				
				str = "";
				for (var i = 0; i < array.length; i++) {
					if(array[i]['flagged'] == 0){
					str += "<div class=\"quote\"> \"" + array[i]['quote'] + "<br> -- "
							+ array[i]['author'] + "<br> <input type=\"button\" value=\"+\" class = \"buttons\" onClick=\"plus(\'" + array[i]['quote'] + "\')\">"
							+ array[i]['rating'] + "<input type=\"button\" value=\"-\" class = \"buttons\" onClick=\"minus(\'" + array[i]['quote'] + "\')\"><input type=\"button\" value=\"flag\" class = \"buttons\" onClick=\"flag(\'" + array[i]['quote'] + "\')\"></div>";
	
					}
				}
	
				var toChange = document.getElementById("toChange");
				toChange.innerHTML = str;
			}
		};
	}
	
	function unflag(){
		var anObj = new XMLHttpRequest();
		anObj.open("GET", "controller.php?n=unflag", true);
		anObj.send();
	
		anObj.onreadystatechange = function() {
			if (anObj.readyState == 4 && anObj.status == 200) {
				populate();
			}
		};
	}
	
	function flag(quote){
		var anObj = new XMLHttpRequest();
		anObj.open("GET", "controller.php?n=flag&quote=" + quote, true);
		anObj.send();
	
		anObj.onreadystatechange = function() {
			if (anObj.readyState == 4 && anObj.status == 200) {
				array = JSON.parse(anObj.responseText);
				populate();
			}
		};
	}
	
	function plus(quote){
		var anObj = new XMLHttpRequest();
		anObj.open("GET", "controller.php?n=plus&quote=" + quote, true);
		anObj.send();
	
		anObj.onreadystatechange = function() {
			if (anObj.readyState == 4 && anObj.status == 200) {
				array = JSON.parse(anObj.responseText);
				populate();
			}
		};
	}
	
	function minus(quote){
		var anObj = new XMLHttpRequest();
		anObj.open("GET", "controller.php?n=minus&quote=" + quote, true);
		anObj.send();
	
		anObj.onreadystatechange = function() {
			if (anObj.readyState == 4 && anObj.status == 200) {
				array = JSON.parse(anObj.responseText);
				populate();
			}
		};
	}
</script>
<?php 
if(isset($_POST['logout'])){
	unset($_SESSION['user']);
	header("Location: index.php");
}
?>
</body>