<?php
ob_start(); //set buffer on
session_start(); //starting session

// Include business layer
require_once('business_layer/business.inc.php');

?>
<!DOCTYPE>
	
<html>
<head>
	<title>PHP Shopping Cart Demo &#0183; </title>
	<link rel="stylesheet" href="css/shopping-styles.css" />
</head>

<body>


<div>

<h2>Caps In Our Store</h2>

<?php
echo Business::displayCaps();
?>

</div>
</body>
</html>