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
echo '<form action="" method="post" id="addsupplier">';
echo 'Name: <input name="txtName" size="20" id="txtName"/><br>';
echo 'Phone: <input name="txtPhone" size="20" id="txtPhone"/><br>';
echo 'Email: <input name="txtEmail" size="20" id="txtEmail"/><br>';
echo 'Address: <input name="txtAddress" size="20" id="txtAddress"/><br>';
echo '<div><button type="submit" name="add">ADD</button></div>';
echo '</form>';
if (isset($_POST['add'])){
	
	$sql = "INSERT INTO supplier(supplierID,supplierName,supplierPhone,supplierEmail,supplierAddress)
        VALUES(NULL,'" .$_POST['txtName']. "','".$_POST['txtPhone']."','".$_POST['txtEmail']."','".$_POST['txtAddress']."')"; 
	
$rs=$mysqli->query($sql);
if (!$rs)
  {exit("Error in SQL");}
}
//Select the file information
$sql="SELECT supplier.supplierID As Supplier_ID,
              supplier.supplierName As Supplier_Name,
              supplier.supplierPhone As Supplier_Phone,
              supplier.supplierEmail As Supplier_Email,
			  supplier.supplierAddress As Supplier_Address
      FROM supplier";
	  
$rs=$mysqli->query($sql);
if (!$rs)
  {exit("Error in SQL");}

//Display the file information in a table
echo "<TABLE BORDER='1'>
      <TR>
      <TH> Supplier_ID </TH>
      <TH> Name </TH>
      <TH> Phone </TH>
      <TH> Email </TH>
	  <TH> Address </TH>
      </TR>";
	  
while ($row = $rs->fetch_assoc())
{
  $supplier_id=$row["Supplier_ID"];
  $supplier_name=$row["Supplier_Name"];
  $supplier_phone=$row["Supplier_Phone"];
  $supplier_email=$row["Supplier_Email"];
  $supplier_address=$row["Supplier_Address"];
  echo "<TR>";
  echo "<TD>$supplier_id</TD>";
  echo "<TD>$supplier_name</TD>";
  echo "<TD>$supplier_phone</TD>";
  echo "<TD>$supplier_email</TD>";
  echo "<TD>$supplier_address</TD>";
  echo "</TR>";
}

echo "</TABLE>";
?>

</body>
</html>
