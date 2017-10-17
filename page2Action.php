<!DOCTYPE>
<html>
<head>
<title>page2Action.php</title>
		
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
$sql = "SELECT * FROM Suppliers
        WHERE SupplierID=$_POST[choice]"; 

//Execute the SQL statement
$rs=odbc_exec($connection, $sql);
if (!$rs)
  {exit("Error in SQL");}

//Select the result
while (odbc_fetch_row($rs))
{
  $id=odbc_result($rs,"SupplierID");
  $compname=odbc_result($rs,"CompanyName");
  $conname=odbc_result($rs,"ContactName");
}

// free resources and close connection 
odbc_close($connection);  
?> 
<FORM NAME="page3Form" METHOD="POST" ACTION="page3Action.php">
<INPUT TYPE="HIDDEN" NAME="SupplierID" VALUE="<?php echo $id; ?>">
<pre>
 Company Name:<INPUT TYPE="TEXT" NAME="CompanyName" VALUE="<?php echo $compname; ?>"><BR>
 Contact Name:<INPUT TYPE="TEXT" NAME="ContactName" VALUE="<?php echo $conname; ?>"><BR>
</pre>
<INPUT TYPE="SUBMIT"><BR> 
</FORM> 
</body>
</html>
