<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>WA2016</title>
    <script src="WABootstrap/bootstrap.js" type="text/javascript">
	</script>
     <script src="WABootstrap/jquery-1.10.2.js" type="text/javascript">
	</script>
    <script src="WABootstrap/modernizr-2.6.2.js" type="text/javascript">
	</script>
    <script src="WABootstrap/respond.js" type="text/javascript">
	</script>
<link href="WABootstrap/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="WAStyleSheet/Practical.css" rel="stylesheet" type="text/css" />
       <script type="text/javascript">
    		function current_time()
		{
			var currentTime = new Date()
			var month = currentTime.getMonth() + 1
			var day = currentTime.getDate()
			var year = currentTime.getFullYear()
			document.write( day+ "/" + month + "/" + year)
		}
    </script>
</head>

<body>

<?php
//Retrieve the requested content page name and construct the file name
if (isset($_GET['content_page']))
{
   $page_name = $_GET['content_page'];
   $page_content = $page_name.'.php';
}
elseif (isset($_POST['content_page']))
{
   $page_name = $_POST['content_page'];
   $page_content = $page_name.'.php';
}
else
{$page_content = 'Introduction.php';}

//This must be below the setting of $page_content 
include('WAMaster.php');
?>

</body>
</html>

