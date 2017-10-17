<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Management</title>
</head>

<body>
<?php
// create connection
$mysqli = new mysqli("localhost", "leroyt01", "21021994", "leroyt01mysql1");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

?>
<?php
//Select the file information
$sql="SELECT  customers.userID As User_ID,
			  customers.userName As User_Name,
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
	  <TH> </TH>
      <TH> User_ID </TH>
	  <TH> Username </TH>
      <TH> Email </TH>
      <TH> Password </TH>
      <TH> User_Type </TH>
	  <TH> User_Status </TH>
      </TR>";
	  
while ($row = $rs->fetch_assoc())
{
  $user_id=$row["User_ID"];
  $user_name=$row["User_Name"];
  $user_email=$row["Email"];
  $user_type=$row["User_Type"];
  $user_status=$row["User_Status"];
  $user_pw=$row["Password"];
  echo "<TR>";
  echo '<TD><a href="index.php?id='.$row['User_ID'].'&content_page=EditUser">Edit</a></TD>';
  echo "<TD>$user_id</TD>";
  echo "<TD>$user_name</TD>";
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
