<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Register</title>

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
	<h1>Register</h1>

	<form name="loginform" method="post">
    	<label>Username</label>
    	<input type="text" name="username"> 
    	<label>Password </label>
    	<input type="password" name="password">
    	<input type="submit" name="Register"/>
	</form>
	<?php
		if(isset($_POST['Register'])){
			$theDBA = new databaseAdaptor();
			$username = $_POST['username'];
			$password = $_POST['password'];
			if($theDBA->checkNewUser($username) == NULL){
				if(strlen($username) >= 4){
					if(strlen($password) >= 6){
						$hash = password_hash($password, PASSWORD_DEFAULT);
						$theDBA->addNewUser($username, $hash);
						header("Location: index.php");
					}
					else{
						echo "<br>Your password is too short";
					}
				}
				else{
					echo "<br>Your username is too short";
				}
			}
			else{
				echo "<br>Account name already exists";
			}
		}
	?>
	<script>
		
	</script>

</body>
</html>

