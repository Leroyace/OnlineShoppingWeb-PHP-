<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Management</title>
</head>

<body>
<?php
/* if (isset($_FILES["paper_file"]) && ($_FILES["paper_file"]["error"] > 0))
  {
  echo "Error: " . $_FILES["paper_ file"]["error"] . "<br />";
  }
elseif (isset($_FILES["paper_file"]))
  {
    move_uploaded_file($_FILES["paper_file"]["tmp_name"], "../uploads/PHPUploaded/" . $_FILES["paper_file"]["name"]); //Save the file as the supplied name
  } */
?>
<?php
// create connection
$mysqli = new mysqli("localhost", "leroyt01", "21021994", "leroyt01mysql1");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
//echo $mysqli->host_info . "\n";
  
// create SQL statement 
/* $sql = "INSERT INTO customers(FirstName,LastName,Title)
        VALUES('" . $_POST['paper_author'] . "','" 
		         . $_FILES["paper_file"]["name"] . "','" 
				 . $_POST['paper_title'] . "')"; 
				 
// execute SQL statement and get results 
if (!$mysqli->query($sql)) {
    echo "SQL operation failed: (" . $mysqli->errno . ") " . $mysqli->error;
}  */
?>
<?php
//Select the file information
$sql="SELECT customers.userName As User_ID,
              customers.email As Email,
              customers.password As Password,
              customers.userType As User_Type,
			  customers.userStatus As User_Status
      FROM customers";
	  
$rs=$mysqli->query($sql);
if (!$rs)
  {exit("Error in SQL");}

//Display the file information in a table
echo "<TABLE BORDER='1'>
      <TR>
      <TH> User_ID </TH>
      <TH> Email </TH>
      <TH> Password </TH>
      <TH> User_Type </TH>
	  <TH> User_Status </TH>
      </TR>";
	  
while ($row = $rs->fetch_assoc())
{
  $user_id=$row["User_ID"];
  $user_email=$row["Email"];
  $user_type=$row["User_Type"];
  $user_status=$row["User_Status"];
  $user_pw=$row["Password"];
  echo "<TR>";
  echo "<TD>$user_id</TD>";
  echo "<TD>$user_pw</TD>";
  echo "<TD>$user_email</TD>";
  echo "<TD>$user_type</TD>";
  echo "<TD>$user_status</TD>";
  echo "</TR>";
}

echo "</TABLE>";
?>

</body>
</html>
