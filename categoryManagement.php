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
echo '<form action="" method="post" id="addcate">';
echo 'Category: <input name="txtCategory" size="20" id="txtCategory"/>';
echo '<div><button type="submit" name="add">ADD</button></div>';
echo '</form>';
if (isset($_POST['add'])){
	
	$sql = "INSERT INTO category(cate_id,category)
        VALUES(NULL,'" .$_POST['txtCategory']. "')"; 
	
$rs=$mysqli->query($sql);
if (!$rs)
  {exit("Error in SQL");}
}
//Select the file information
$sql="SELECT category.cate_id As Cate_ID,
              category.category As Category
      FROM category";
	  
$rs=$mysqli->query($sql);
if (!$rs)
  {exit("Error in SQL");}

//Display the file information in a table
echo "<TABLE BORDER='1'>
      <TR>
      <TH> Cate_ID </TH>
      <TH> Category </TH>
      </TR>";
	  
while ($row = $rs->fetch_assoc())
{
  $cate_id=$row["Cate_ID"];
  $cate=$row["Category"];
  echo "<TR>";
  echo "<TD>$cate_id</TD>";
  echo "<TD>$cate</TD>";
  echo "</TR>";
}

echo "</TABLE>";
?>

</body>
</html>
