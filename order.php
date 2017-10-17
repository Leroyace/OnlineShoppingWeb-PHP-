<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Order</title>
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
$sql="SELECT orders.orderID As Order_ID,
              orders.orderStatus As Order_Status,
              orders.orderCustomerID As Order_CustomerID,
			  orders.orderGrandtotal As Order_Grandtotal
      FROM orders where orderCustomerID = ".$_SESSION['uid'];
	  
$rs=$mysqli->query($sql);
if (!$rs)
  {exit("Error in SQL");}
if(mysqli_num_rows($rs) == 0){
	echo '<p>You have no orders in your order list</p>';
}
else{
//Display the file information in a table
echo '<form action="" method="post" id="changeStatus">';
echo "<TABLE BORDER='1'>
      <TR>
	  <th> </th>
      <TH> Order_ID </TH>
      <TH> Status </TH>
	  <TH> Grandtotal </TH>
      </TR>";
	  
while ($row = $rs->fetch_assoc())
{
  $order_id=$row["Order_ID"];
  $order_status=$row["Order_Status"];
  $order_customerID=$row["Order_CustomerID"];
  $order_grandtotal=$row["Order_Grandtotal"];
  echo "<TR>";
  echo '<TD><a href="index.php?id='.$row['Order_ID'].'&content_page=orderItem">See Info</a></TD>';
  echo "<TD>$order_id</TD>";
  echo "<TD>$order_status</TD>";
  echo "<TD>$order_grandtotal</TD>";
  echo "</TR>";
}

echo "</TABLE></form>";

}
?>
</body>
</html>
