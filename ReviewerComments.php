<!DOCTYPE>
<html>
<head>
<title>ReviewerComments</title>
		
<LINK href="WAStyleSheet/Practical.css" type="text/css" rel="STYLESHEET">
</head>

<body>
<?php
if (isset($_FILES["icon_file"]) and ($_FILES["icon_file"]["error"] > 0))
 {
  echo "Error: " . $_FILES["icon_ file"]["error"] . "<br />";
  }
elseif (isset($_FILES["icon_file"]))
  {
  move_uploaded_file($_FILES["icon_file"]["tmp_name"], "../uploads/PHPUploaded/" . $_FILES["icon_file"]["name"]); //Save the file as the supplied name
  }
 ?>
 
<?php
// create connection
$conn=odbc_connect('xliaccess1','','');
if (!$conn)
  {exit("Connection Failed: " . $conn);}
 
if (isset($_POST['paper_ID']) && ($_POST['paper_ID'] != ''))
{
// create SQL statement  
$sql = "UPDATE Employees 
        SET City = '". $_FILES["icon_file"]["name"] . 
      "' WHERE EmployeeID =". $_POST['paper_ID'];
	   
// prepare SQL statement 
$sql_result = odbc_prepare($conn, $sql); 

// execute SQL statement and get results 
odbc_execute($sql_result); 

// free resources and close connection 
odbc_free_result($sql_result); 
odbc_close($conn); 
}

?>

<?php

//Select the file information
$sql="SELECT Employees.EmployeeID As paper_ID,
              Employees.FirstName As paper_author,
              Employees.Title As paper_title,
			  Employees.City As paper_icon 
      FROM Employees";
	  
$rs1=odbc_exec($conn,$sql);
if (!$rs1)
  {exit("Error in SQL");}
?>
<TABLE><TR><TD> <!-- Page outline table first column starts -->
<TABLE bgcolor="silver" border="2"> <!-- File information table starts -->
  <TR>
    <TH> paper ID </TH>
    <TH> paper author </TH>
    <TH> paper title </TH>
    <TH> paper icon </TH>
  </TR>

<?php  
//Display the file information in a table
while (odbc_fetch_row($rs1))
{
  $paper_id=odbc_result($rs1,"paper_ID");
  $paper_author=odbc_result($rs1,"paper_author");
  $paper_tile=odbc_result($rs1,"paper_title");
  $paper_icon=odbc_result($rs1,"paper_icon");
  echo "<TR>";
  echo "<TD>$paper_id</TD>";
  echo "<TD>$paper_author</TD>";
  echo "<TD>$paper_tile</TD>";
  echo "<TD><div style='background: #FFCCFF; height:60; width:60; padding:10px'>
            <img src='../uploads/PHPUploaded/" . $paper_icon ."' width='50' height='50' onClick=\"window.location='ReviewerComments.php?PaperID=" 
			.$paper_id . "'\"></div></TD>";
  echo "</TR>";
}
odbc_close($conn);

?>
</TABLE> <!-- File information table ends -->

<!-- Page outline table first column ends, second column starts-->
</TD><TD valign="top">
<?php
if (isset($_GET['PaperID']) && ($_GET['PaperID'] != ''))
{
$sql= "SELECT Employees.Address As paper_comments, Employees.Title As paper_title
       FROM Employees
       WHERE EmployeeID =". $_GET['PaperID'];
	  
$rs=odbc_exec($conn,$sql);
if (!$rs)
  {exit("Error in SQL");}
  
while (odbc_fetch_row($rs))
{
$paper_tile=odbc_result($rs,"paper_title");
$comments=odbc_result($rs,"paper_comments");
echo "<br> The reviewers' comments for paper " . $paper_tile ."<br>";
echo "<textarea id='Comments' rows='5' cols='60'>" . $comments ."</textarea>";
}
?>
<!-- Page outline table second column ends, page outline table ends-->
</TD></TR></TABLE>

<script>
    Comments.focus()
</script>
<?php 
} 
odbc_close($conn); 
?>

</body>
</html>
