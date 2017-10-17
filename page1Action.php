<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>page1Action.php</title>
		
        <LINK REL="STYLESHEET" TYPE="text/css" HREF="WAStyleSheet/Practical.css">
</head>

<body>

<?php 

// create connection 
$connection = odbc_connect("xli2016s2_wadaccess1","",""); 

// test connection 
if (!$connection) { 
echo "Couldn't make a connection!"; 
exit; 
} 

// create SQL statement 
$sql = "SELECT * FROM Suppliers WHERE SupplierID < 4"; 

//Execute the SQL statement
$rs=odbc_exec($connection, $sql);
if (!$rs)
  {exit("Error in SQL");}

//Output the result in an HTML table
//Table head
echo "<table border='2'><tr>";
echo "<th>Supplier ID</th>";
echo "<th>Company Name</th>";
echo "<th>Contact Name</th></tr>";

//Table body
while (odbc_fetch_row($rs))
{
  $id=odbc_result($rs,"SupplierID");
  $compname=odbc_result($rs,"CompanyName");
  $conname=odbc_result($rs,"ContactName");
  echo "<tr><td>$id</td>";
  echo "<td>$compname</td>";
  echo "<td>$conname</td></tr>";
}

echo "</table>";

// free resources and close connection 
odbc_close($connection);  
?> 

<?php
// Search for an input name 
// create SQL statement 
$sql = "SELECT * FROM Customers 
		WHERE ContactName ='$_GET[StudentName]'"; 

//Execute the SQL statement
$rs_search=odbc_exec($connection, $sql);
if (!$rs_search)
  {exit("Error in SQL");}

//Count the record number
$counter = 0;
while (odbc_fetch_row($rs_search))
{
   $counter++;
}

 if ($counter == 0)
  echo "<SPAN class='caption'> The input student is not in our database </SPAN><br>";
 else  
  echo "<SPAN class='caption'> The input student is found</SPAN><br>";

// free resources and close connection 
odbc_close($connection); 
  
?>
<form name="page2Form" METHOD="POST" action="page2Action.php">
<?php 

// create connection 
$connection = odbc_connect("xli2016s2_wadaccess1","",""); 

// test connection 
if (!$connection) { 
echo "Couldn't make a connection!"; 
exit; 
} 

// create SQL statement 
$sql = "SELECT * FROM Suppliers"; 

//Execute the SQL statement
$rs=odbc_exec($connection, $sql);
if (!$rs)
  {exit("Error in SQL");}

//Output the result in an HTML table
//Table head
echo "<table border='2'><tr>";
echo "<th>Supplier ID</th>";
echo "<th>Company Name</th>";
echo "<th>Contact Name</th>";
echo "<th>Country</th>";
echo "<th>Choice</th></tr>";

//Table body
while (odbc_fetch_row($rs))
{
  $id=odbc_result($rs,"SupplierID");
  $compname=odbc_result($rs,"CompanyName");
  $conname=odbc_result($rs,"ContactName");
  $contry=odbc_result($rs,"Country");
  echo "<tr><td>$id</td>";
  echo "<td>$compname</td>";
  echo "<td>$conname</td>";
  echo "<td>$contry</td>";
  echo "<td><input type='radio' name='choice' checked='true' value=$id></td></tr>";
}

echo "</table>";

// free resources and close connection 
odbc_close($connection);  
?> 
<INPUT TYPE="SUBMIT"><br/>
</form>
</body>
</html>
