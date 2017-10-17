<?php
require("ErrorFunctions.php");
//Sets a user function (error_handler) to handle errors in a script
$error_handler = set_error_handler("userErrorHandler");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Action Page</title>
</head>

<body>
<?php
if (isset($_FILES["paper_file"]) && ($_FILES["paper_file"]["error"] > 0))
  {
  echo "Error: " . $_FILES["paper_ file"]["error"] . "<br />";
  }
  elseif (isset($_FILES["paper_file"]))
  {
    move_uploaded_file($_FILES["paper_file"]["tmp_name"], "../uploads/PHPUploaded/" . $_FILES["paper_file"]["name"]); //Save the file as the supplied name
  }
  else
  {
	 trigger_error("No file supplied", E_USER_ERROR);
  }
?>

<?php
// create connection
$conn=odbc_connect('xli2016s2_wadaccess1','','');

if (!$conn)
  {exit("Connection Failed: " . $conn);}
  
// create SQL statement 
$sql = "INSERT INTO Employees([FirstName],[LastName],[Title])
        VALUES('" . $_POST['paper_author'] . "','" 
		         . $_FILES["paper_file"]["name"] . "','" 
				 . $_POST['paper_title'] . "')"; 
// prepare SQL statement 
$sql_result = odbc_prepare($conn, $sql); 

// execute SQL statement and get results 
odbc_execute($sql_result); 

// free resources 
odbc_free_result($sql_result); 
?>

<?php
//Select the file information
$sql="SELECT Employees.EmployeeID As paper_ID,
              Employees.[FirstName] As paper_author,
              Employees.[LastName] As paper_file,
              Employees.[Title] As paper_title 
      FROM Employees";
	  
$rs=odbc_exec($conn,$sql);
if (!$rs)
  {exit("Error in SQL");}

//Display the file information in a table
echo "<TABLE BORDER='1'>
      <TR>
      <TH> paper ID </TH>
      <TH> paper author </TH>
      <TH> paper file </TH>
      <TH> paper title </TH>
      </TR>";
	  
while (odbc_fetch_row($rs))
{
  $paper_id=odbc_result($rs,"paper_ID");
  $paper_author=odbc_result($rs,"paper_author");
  $paper_file=odbc_result($rs,"paper_file");
  $paper_title=odbc_result($rs,"paper_title");
  echo "<TR>";
  echo "<TD>$paper_id</TD>";
  echo "<TD>$paper_author</TD>";
  echo "<TD>$paper_file</TD>";
  echo "<TD>$paper_title</TD>";
  echo "</TR>";
}
odbc_close($conn);
echo "</TABLE>";
?>
</body>
</html>
