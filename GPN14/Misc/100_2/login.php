<?php
$USERNAME="admin";
$PASSWORD="UFETEST";
$FLAG="sqrts{abcdef}";

if (isset($_POST["username"]) && isset($_POST["password"]) && $_POST["username"]!="" && $_POST["password"] != "") {
	if ($_POST["username"] === $USERNAME && $_POST["password"] === $PASSWORD) {
		echo $FLAG;
	}else{
		echo '<div style="color: red">Wrong username or password!</div>';
	}
}else{
	if (isset($_POST["submit"])) {
		echo '<div style="color: red">Please enter a username and a password!</div>';
	}
}
?>
<html>
<head>
<title>Login</title>
</head>

<body>
<form action="login.php" method="POST">
Username: <input name="username" /></br>
Password: <input type="password" name="password" /></br></br>
<input type="submit" name="submit" />
</form>

</body>
</html>
