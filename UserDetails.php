<?php
   function checkUserCredentals($inputUsername, $inputPassword)
   {
   /*
   This function takes input username and password as parameters and 
   returns TRUE if the user is authenticated, FALSE if the user is not authenticated
   */
	   
	   //create connection
	  $conn=odbc_connect('leroyt01','','');
	  
	  if (!$conn)
		{exit("Connection Failed: " . $conn);}
		
	  // query the users table for name and surname 
	  $sql = "SELECT [LastName], [FirstName] FROM Employees Where [LastName]='".$inputUsername."' AND [FirstName]='".$inputPassword."'";
	  
	  // perform the query
	   $result = odbc_exec($conn, $sql);
	   
	   //Count the record number
	  $counter = 0;
	  while (odbc_fetch_row($result))
	  {
		 $counter++;
	  }
      
	  if ($counter>0)
	  {
		  //authentication succeeded
		  return (true);
	  }
	  else
	  {
		  //authentication failed
		  return (false);	
	  }
   }
   
?>


