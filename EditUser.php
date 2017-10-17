<?php
// create connection
$mysqli = new mysqli("localhost", "leroyt01", "21021994", "leroyt01mysql1");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
//Select the file information
$sql="SELECT  customers.userID As User_ID,
			  customers.userName As User_Name,
              customers.email As Email,
              customers.password As Password,
              customers.userType As User_Type,
			  customers.userStatus As User_Status 
      FROM customers where customers.userID = " .$_GET['id'];
	  
$rs=$mysqli->query($sql);
if (!$rs)
  {exit("Error in SQL");}

//Display the file information in a table
echo "<form action='' method='post' id='editUser'>
	  <TABLE BORDER='1'>
      <TR>
      <TH> User_ID </TH>
	  <TH> Username </TH>
      <TH> Email </TH>
      <TH> Password </TH>
      <TH> User_Type </TH>
	  <TH> User_Status </TH>
	  <TH>  </TH>
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
  echo "<TD>$user_id</TD>";
  echo "<TD>$user_name</TD>";
  echo "<TD>$user_pw</TD>";
  echo "<TD>$user_email</TD>";
  echo "<TD>$user_type</TD>";
  echo "<TD ALIGN='center'>
       <select name='ustatus'>
            <option value='pass'>pass</option>
            <option value='deny'>deny</option>
       </select>
    </TD>";
  echo "<TD>'<div><button type='submit' name='update'>Update</button></div>'</TD>";
  echo "</TR>";
}

echo "</TABLE></form>";
if (isset($_POST['ustatus'])){
	
	$sql = "UPDATE customers SET customers.userStatus='".$_POST['ustatus']."' WHERE userID=$user_id";
	
$rs=$mysqli->query($sql);
if (!$rs)
  {exit("Error in SQL");}
  else{
	header("Location: index.php?content_page=userManagement");
}
}

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
