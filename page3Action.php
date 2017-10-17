<html>

<head>
	<title>ISCG7420 Page</title>
	<LINK REL=STYLESHEET TYPE="text/css" HREF="WAStyleSheet/Practical.css">
</head>

<body ID=bodyID>
<?php

	if(isset($_POST['CompanyName']))
	{
	// create connection 
	$connection = odbc_connect("xli2016s2_wadaccess1","",""); 

	// test connection 
	if (!$connection) { 
	echo "Couldn't make a connection!"; 
	exit; }
	
	// create SQL statement 
	$sql = "UPDATE Suppliers
			SET CompanyName='$_POST[CompanyName]',
			    ContactName='$_POST[ContactName]'
			WHERE SupplierID=$_POST[SupplierID]"; 
	
	// prepare SQL statement 
    $sql_result = odbc_prepare($connection,$sql); 

    // execute SQL statement and get results 
    odbc_execute($sql_result); 

	// free resources and close connection 
	odbc_free_result($sql_result); 
	odbc_close($connection); 
	} //end if
	
		// create connection 
	$connection = odbc_connect("xli2016s2_wadaccess1","",""); 

	// test connection 
	if (!$connection) { 
	echo "Couldn't make a connection!"; 
	exit; }
	
	// create another SQL statement 
	$sql = "SELECT * FROM Suppliers"; 
	
	//Execute the SQL statement
	$rs=odbc_exec($connection, $sql);
	if (!$rs)
	  {exit("Error in SQL");}

	//Count the record number
	$counter = 0;
	while (odbc_fetch_row($rs))
	{
	   $counter++;
	}
	
	/*$counter = count($rs);*/
	
	$PageSize=5;
    $PageCount=$counter/$PageSize + 1;
	
	//Output page index table
	echo "<table ID=tableID border=2>";
	echo "<tr>";
	for( $i=1; $i <= $PageCount; $i++)
	{
	echo "<td><a href=page3Action.php?pg=$i> Page $i</a></td>";
	} //end for
	echo "</tr></table><br>";
?>
	<TABLE border="2">
	  <TR>
	    <TH> Supplier ID </TH>
	    <TH> Company Name </TH>
	    <TH> Contact Name </TH>
        <TH> Contact Title </TH>
	  </TR>
	  
<?php   

   // Test if this is the first page 
	if (isset($_GET['pg']))
	{
	// set the parameters for the rest pages 
	$start= ($_GET['pg']-1)*$PageSize + 1;
	$end= $_GET['pg']*$PageSize;
	if( $end > $counter )
	  $end = $counter;
	}
	else
	{
	//set the parameters for the first page
	$start= 1;
	$end= $PageSize;
	if( $end > $counter )
	  $end = $counter;
	}//end if IsSet("$_GET['pg']")
	
	//Display the page 
	for( $i=$start; $i <= $end; $i++)
	{
	  odbc_fetch_row($rs, $i);
	  $id=odbc_result($rs,"SupplierID");
	  $compname=odbc_result($rs,"CompanyName");
	  $conname=odbc_result($rs,"ContactName");
	  $job=odbc_result($rs,"ContactTitle");
	  echo "<tr><td>$id</td>";
	  echo "<td>$compname</td>";
	  echo "<td>$conname</td>";
	  echo "<td>$job</td></tr>";
	}
	
	echo "</table>";
	    
	//close connection 
	odbc_close($connection);  
	?>
</body>
</html>