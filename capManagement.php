<?php
require("ErrorFunctions.php");
//Sets a user function (error_handler) to handle errors in a script
$error_handler = set_error_handler("userErrorHandler");
?>
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
$sql="SELECT category.cate_id As Cate_ID,
              category.category As Category
      FROM category";
	  
$rs=$mysqli->query($sql);
if (!$rs)
  {exit("Error in SQL");}
echo '<form action="" method="post" id="addcap">';
echo 'Cap Name: <input name="txtCapName" size="20" id="txtCapName"/><br>';
echo 'Image:<input type="File" name="paper_file" value="" size="30">';
echo 'Category:  
       <select name="category">';
while ($row = $rs->fetch_assoc())
{
  $cate_id=$row["Cate_ID"];
  $cate=$row["Category"];
  echo '<option value="'.$cate_id.'">'.$cate.'</option>';
}
	   echo '</select>
     <br>';
echo 'Price: <input name="txtPrice" size="20" id="txtPrice"/><br>';
//Select the file information
$sql="SELECT supplier.supplierID As Supplier_ID,
              supplier.supplierName As Supplier_Name
      FROM supplier";
$rs=$mysqli->query($sql);
if (!$rs)
  {exit("Error in SQL");}
echo 'Supplier: <select name="supplier">';
while ($row = $rs->fetch_assoc())
{
  $supplier_id=$row["Supplier_ID"];
  $supplier_name=$row["Supplier_Name"];
  echo '<option value="'.$supplier_id.'">'.$supplier_name.'</option>';
}
	   echo '</select>';
echo '<div><button type="submit" name="add">ADD</button></div>';
echo '</form>';
if (isset($_POST['add'])){
	$target_dir = "PHPUploaded/";
	$target_file = $target_dir . basename($_FILES["paper_file"]["name"]);
  if (move_uploaded_file($_FILES["paper_file"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
	$sql = "INSERT INTO caps(CapID,CapName,CapCate,CapPrice,CapSupplier)
        VALUES(NULL,'" .$_POST['txtCapName']. "','".$_POST['category']."','".$_POST['txtPrice']."','".$_POST['supplier']."')"; 
	
$rs=$mysqli->query($sql);
if (!$rs)
  {exit("Error in SQL");}
}

//Select the file information
$sql="SELECT caps.CapID As Cap_ID,
              caps.CapName As Cap_Name,
              caps.CapCate As Cap_Cate,
              caps.CapPrice As Cap_Price,
			  caps.CapSupplier As Cap_Supplier
      FROM caps";
	  
$rs=$mysqli->query($sql);
if (!$rs)
  {exit("Error in SQL");}

//Display the file information in a table
echo "<TABLE BORDER='1'>
      <TR>
      <TH> Cap_ID </TH>
	  <TH> Image </TH>
      <TH> Name </TH>
      <TH> Category </TH>
      <TH> Price </TH>
	  <TH> Supplier </TH>
      </TR>";
	  
while ($row = $rs->fetch_assoc())
{
  $cap_id=$row["Cap_ID"];
  $cap_name=$row["Cap_Name"];
  $cap_cate=$row["Cap_Cate"];
  $cap_price=$row["Cap_Price"];
  $cap_supplier=$row["Cap_Supplier"];
  echo "<TR>";
  echo "<TD>$cap_id</TD>";
  echo "<TD><img src='PHPUploaded/cap".$cap_id.".jpg' width='50' height='50' /></TD>";
  echo "<TD>$cap_name</TD>";
  echo "<TD>$cap_cate</TD>";
  echo "<TD>$cap_price</TD>";
  echo "<TD>$cap_supplier</TD>";
  echo "</TR>";
}

echo "</TABLE>";
?>

</body>
</html>
