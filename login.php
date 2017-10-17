<?php

// create connection
$mysqli = new mysqli("localhost", "leroyt01", "21021994", "leroyt01mysql1");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
if(isset($_POST['submit']))
{
 
	$uname = $_POST['uname'];
 	$pass = $_POST['pass'];
 	
	
 $sql = "SELECT * FROM customers WHERE userName LIKE '".$uname."' AND password LIKE '".$pass."' AND userStatus LIKE 'pass' AND userType='Admin'";
 $sql2 = "SELECT * FROM customers WHERE userName LIKE '".$uname."' AND password LIKE '".$pass."' AND userStatus LIKE 'pass' AND userType='user'";
 
   
 $check = $mysqli->query($sql);
 $ulogcheck = $mysqli->query($sql2);
 
 if(mysqli_num_rows($check) != 0){
  $_SESSION['AdminLogged'] = true;
  $_SESSION['Logged'] = true;
  $_SESSION['uname'] = $uname;
  $row = $check->fetch_assoc();
	$_SESSION['uid'] = $row["userID"];
  header("Location: index.php?content_page=product");
  exit();
 }
 else if(mysqli_num_rows($ulogcheck) != 0){
	$_SESSION['Logged'] = true; 
	$_SESSION['uname'] = $uname;
	$row = $ulogcheck->fetch_assoc();
	$_SESSION['uid'] = $row["userID"];
  header("Location: index.php?content_page=product");
  exit();
 }
 else{

  echo 'Sorry the username or password provided is not correct,<a href="index.php?content_page=login">Log in</a><br><a href="index.php?content_page=register">Sign Up</a>';
 }
}
else{

 $form = <<<EOT
 <form action="index.php?content_page=login" method="POST">
 Username: <input type="text" name="uname"><br>
 Password: <input type="password" name="pass"><br>
 <input type="submit" name="submit" value="Log in">

EOT;

echo $form;
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
</head>

<body>

</body>
</html>