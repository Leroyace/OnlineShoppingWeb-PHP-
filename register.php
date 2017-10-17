<?php
// create connection
$mysqli = new mysqli("localhost", "leroyt01", "21021994", "leroyt01mysql1");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
if (isset($_POST['submit']))
{
	$username = $_POST['name'];
 	$email1 = $_POST['email1'];
 	$email2 = $_POST['email2'];
 	$pass1 = $_POST['pass1'];
 	$pass2 = $_POST['pass2'];

 if($email1 == $email2 && $pass1 == $pass2 && $email1 != '' && $pass1 != '')
 {
   
   // create SQL statement 
	
				
   $sql = "SELECT * FROM customers WHERE userName LIKE '".$username."'";
   
   $check = $mysqli->query($sql);
   if (mysqli_num_rows($check)>=1) echo 'Username already registed <a href="index.php?content_page=register">Click Here</a>';
   //Put everyting in DB
   else{
  	$sql2 = "INSERT INTO customers(userID,userName,email,password,userType,userStatus)
        VALUES(NULL,'" . $username . "','" 
		         . $email1 . "','" 
				 . $pass1 . "','user','pass')"; 
				 if (!$mysqli->query($sql2)) {
    						echo "SQL operation failed: (" . $mysqli->errno . ") " . $mysqli->error;
						} 
						else{
							$to      = $email1;
							$subject = 'Welcome';
							$message = 'Hello';
							$headers = 'From: leioy0403@hotmail.com' ;

							if(mail($to, $subject, $message, $headers,"Context-type: text/html\n")) echo 'Registration Successful <a href="index.php?content_page=login">Click Here</a>';
							else{
								echo 'Registration Successful <a href="index.php?content_page=login">Click Here</a>';
							}
							
   							}
		}
   
   			
 }
 else{
  echo 'Sorry, your email\'s or your passwords do not match.<a href="index.php?content_page=register">Click Here</a><br />';
 }




}
else{
$form = <<<EOT
<form action="index.php?content_page=register" method="POST">
Username: <input type="text" name="name" /><br />
Email: <input type="text" name="email1" /><br />
Confirm Email: <input type="text" name="email2" /><br />
Password: <input type="password" name="pass1" /><br />
Confirm Password: <input type="password" name="pass2" /><br />
<input type="submit" value="Register" name="submit" />
</form>
EOT;

echo $form;

}

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Register</title>
</head>

<body>
</body>
</html>