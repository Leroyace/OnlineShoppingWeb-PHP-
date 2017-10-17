<?php
    ob_start(); //set buffer on
    session_start(); //starting session
	
   // include username and password array and the function
   require("UserDetails.php");
    
	// if the user has input username and password
	if (isset($_POST['form_username']) and isset($_POST['form_password']))
    {			
		//The login is not successful, set the login flag to false
	        $_SESSION['flag'] = false;
			
			// call the pre-defined function and check if user is authenticated
			if (checkUserCredentals($_POST['form_username'], $_POST['form_password']))
			{
			//The login is successful, set the login flag to true and save the current user name
		    $_SESSION['flag'] = true;
			$_SESSION['current_user'] = $_POST['form_username'];
					
			//redirect the user to the correct page
			ob_end_clean();
			
			//find out where to go after login
			if (isset($_SESSION['request_page']))
		    $redirect_page = "http://dochyper.unitec.ac.nz/leroyt01/PHPAssignment/index.php?content_page=".$_SESSION['request_page'];
			else
			$redirect_page = "http://dochyper.unitec.ac.nz/leroyt01/PHPAssignment/index.php";
				
            //redirect the user to the correct page after login
			header("Location: ".$redirect_page);
			}
	} //Otherwise, stay in the login page
	
?>
<!-- User credential form -->
<form method="post">
Username: <input style="color:#000000;" type="text" name="form_username"><br>
Password: <input style="color:#000000;" type="password" name="form_password"><br>
<input type="submit" value="Submit">
</form>
