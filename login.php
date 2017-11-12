<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>

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
	<h1>Login</h1>

	<form name="loginform" method="post">
    	<label>Username</label>
    	<input type="text" name="username"> 
    	<label>Password </label>
    	<input type="password" name="password">
    	<input type="submit" name="Login"/>
	</form>
	<?php
		if(isset($_POST['Login'])){
			$theDBA = new databaseAdaptor();
			$username = $_POST['username'];
			$password = $_POST['password'];
			$user = $theDBA->checkNewUser($username);
			if($user == NULL){
				echo "<br>Username does not exist";
			} else{
				if(strtolower($user[0]["username"]) === strtolower($username)){
					if(password_verify($password, $user[0]["hash"])){
						$_SESSION['user'] = $username;
						header("Location: index.php");
					} 
					else {
						echo "<br>Password is incorrect, try again";
					}
				}
			}
			
		}
	?>
	<script>
		
	</script>

</body>
</html>