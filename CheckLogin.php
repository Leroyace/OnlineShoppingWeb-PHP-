<?php
    ob_start(); //set buffer on
    session_start(); //starting session

    //checking if user is not authenticated
	if (!isset($_SESSION['flag']) || ($_SESSION['flag'] == false))
    {
		if (!$_GET['content_page'])
		{
		$full_name = $_SERVER['PHP_SELF'];
		$full_name = str_replace(".php","",$full_name);
		$full_name = str_replace("/leroyt01/PHPAssignment/","",$full_name);
		}
		else
		{
        //save the current page name from the input parameter of index.php
		$full_name = $_GET['content_page'];
		}
		
		//Save the file name requested initially
		$_SESSION['request_page'] = $full_name;
		//redirecting user to the login page
		header("Location: http://dochyper.unitec.ac.nz/leroyt01/PHPAssignment/index.php?content_page=PracticalLogin");
        exit;
    }
	else
	{
	    echo "Welcome user " . $_SESSION['current_user'] . "<br>";	
    }
?>

