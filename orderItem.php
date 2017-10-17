<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Order Item</title>
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
$sql="SELECT *
      FROM orderitem where orderID =" .$_GET['id'];
	  
$rs=$mysqli->query($sql);
if (!$rs)
  {exit("Error in SQL");}

//Display the file information in a table
echo '<form action="" method="post" id="changeStatus">';
echo "<TABLE BORDER='1'>
      <TR>
	  <TH> Image </TH>
	  <th> Cap Name </th>
      <TH> Unit Price </TH>
      <TH> Quantity </TH>
	  <TH> Sub Total </TH>
      </TR>";
	  
while ($row = $rs->fetch_assoc())
{	
  $sql2 = 'SELECT * FROM caps WHERE CapID = '.$row["orderCapID"].'';
  $rs2 = $mysqli->query($sql2);
  $row2 = $rs2->fetch_assoc();
  $subtotal = $row['itemQuantity'] * $row['itemPrice'];
  echo "<TR>";
  echo "<TD><img src='PHPUploaded/cap".$row["orderCapID"].".jpg' width='50' height='50' /></TD>";
  echo "<TD>".$row2['CapName']."</TD>";
  echo "<TD>$".$row['itemPrice']."</TD>";
  echo "<TD>".$row['itemQuantity']."</TD>";
  echo "<TD>$$subtotal</TD>";
  echo "</TR>";
}

echo "</TABLE></form>";
?>
</body>
</html>
