<?php
// Include MySQL class
require_once('/data_layer/data.inc.php');

class Business {
	//Display a summary of the shooping cart
	public static function writeShoppingCart() {
	if (isset($_SESSION['cart']))
	{
	$cart = $_SESSION['cart'];
	}
	
	if (!isset($cart) || $cart=='') {
		return '<p>You have no items in your shopping cart</p>';
		$_SESSION['itemCount'] = 0;
	} else {
		// Parse the cart session variable
		$items = explode(',',$cart);
		$s = (count($items) > 1) ? 's':'';
		$_SESSION['itemCount'] = count($items);
		return '<p>You have <a href="index.php?content_page=cart">'.count($items).' item'.$s.' in your shopping cart</a></p>';
	}
    }
	
	
	//Display shopping cart
	public static function showCart() {
	global $db;
	$cart = $_SESSION['cart'];
	if ($cart) {
		$items = explode(',',$cart);
		$contents = array();
		$total = 0;
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		$output[] = '<form action="" method="post" id="cart">';
		$output[] = '<table>';
		foreach ($contents as $id=>$qty) {
			$sql = 'SELECT * FROM caps WHERE CapID = '.$id;
			$result = $db->query($sql);
			$row = $result->fetch();
			extract($row);
			$output[] = '<tr  align="center">';
			$output[] = '<td><img src="PHPUploaded/cap'.$id.'.jpg" width="50" height="50" /></td>';
			$output[] = '<td>'.$CapName.'</td>';
			$output[] = '<td>$'.$CapPrice.'</td>';
			$output[] = '<td><input type="text" name="qty'.$id.'" value="'.$qty.'" size="3" maxlength="3" /></td>';
			$output[] = '<td>$'.($CapPrice * $qty).'</td>';
			$output[] = '<td><a href="index.php?action=delete&id='.$id.'&content_page=cart" class="r">Remove</a></td>';
			$total += $CapPrice * $qty;
			
			$output[] = '</tr>';
			
		}
		$output[] = '</table>';
		$output[] = '<p>Grand total: <strong>$'.$total.'</strong></p>';
		$output[] = '<div><button type="submit" name="update">Update cart</button><button type="submit" name="clear">Clear cart</button><button type="submit" name="checkout">Check out</button></div>';
		$output[] = '</form>';
		$_SESSION['totel'] = $total;
	} else {
		$output[] = '<p>You shopping cart is empty.</p>';
	}
	return join('',$output);
}

    //Process shopping actions
	public static function processActions() {
	if (isset($_SESSION['cart']))
	{
		$cart = $_SESSION['cart'];
	}
	
	if (isset($_GET['action']))
	{
		$action = $_GET['action'];
	}
	if (isset($_POST['update']))
	{
		$action = 'update';
	}
	if (isset($_POST['clear']))
	{
		$action = 'clear';
	}
	if (isset($_POST['checkout']))
	{
		$action = 'checkout';
	}
    switch ($action) {
	case 'add':
		if (isset($cart) && $cart!='') {
			$cart .= ','.$_GET['id'];
		} else {
			$cart = $_GET['id'];
		}
		break;
	case 'delete':
		if ($cart) {
			$items = explode(',',$cart);
			$newcart = '';
			foreach ($items as $item) {
				if ($_GET['id'] != $item) {
					if ($newcart != '') {
						$newcart .= ','.$item;
					} else {
						$newcart = $item;
					}
				}
			}
			$cart = $newcart;
		}
		break;
	case 'clear':
		if ($cart) {
			$_SESSION['itemCount'] = 0;
			$cart = '';
		}
		break;
	case 'checkout':
		if ($_SESSION['Logged'] == true) {
			global $db;
			$cart = $_SESSION['cart'];
			if ($cart) {
				$sql = "INSERT INTO orders(orderID,orderStatus,orderCustomerID,orderGrandtotal)
        VALUES(NULL,'waiting','" 
		         . $_SESSION['uid'] . "','" 
				 . $_SESSION['totel'] . "')"; 
				 	
				$result = $db->query($sql);
				$last_id = $result->insertID();
				
				$items = explode(',',$cart);
				$contents = array();
				$total = 0;
				foreach ($items as $item) {
					$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
				}
			foreach ($contents as $id=>$qty) {
				$sql = 'SELECT * FROM caps WHERE CapID = '.$id;
				
				$result = $db->query($sql);
				$row = $result->fetch();
				extract($row);
				$sql2 = "INSERT INTO orderitem(orderItemID,orderCapID,orderID,itemQuantity,itemPrice)
        VALUES(NULL,'".$id."','".$last_id."','".$qty."','" 
				 . $CapPrice . "')"; 
				if (!$db->query($sql2)) {
    						echo "SQL operation failed: (" . $db->errno . ") " . $db->error;
						} 
				else{
					header("Location: index.php?content_page=order");
					$_SESSION['itemCount'] = 0;
					$cart = '';
				}
			} 
			}
		}
		else{
			header("Location: index.php?content_page=login");
		}
		break;
	case 'update':
	if ($cart) {
		$newcart = '';
		foreach ($_POST as $key=>$value) {
			if (stristr($key,'qty')) {
				$id = str_replace('qty','',$key);
				$items = ($newcart != '') ? explode(',',$newcart) : explode(',',$cart);
				$newcart = '';
				foreach ($items as $item) {
					if ($id != $item) {
						if ($newcart != '') {
							$newcart .= ','.$item;
						} else {
							$newcart = $item;
						}
					}
				}
				for ($i=1;$i<=$value;$i++) {
					if ($newcart != '') {
						$newcart .= ','.$id;
					} else {
						$newcart = $id;
					}
				}
			}
		}
	}
	$cart = $newcart;
	break;
}
$_SESSION['cart'] = $cart;
}

    //Disply available caps
	public static function displayCaps() {
	global $db;
	if(isset($_GET['cate'])){
		$cate = $_GET['cate'];
		$sql = 'SELECT * FROM caps WHERE CapCate = '.$cate.' ORDER BY CapID';
		$result = $db->query($sql);
	}
	else{
		$sql = 'SELECT * FROM caps ORDER BY CapID';
		$result = $db->query($sql);
	}
	$output[] = "<table>";
	$i = 0;
	while ($row = $result->fetch()) {
			$sql2 = 'SELECT * FROM category WHERE cate_id = '.$row["CapCate"].'';
			$rs = $db->query($sql2);
			$sql3 = 'SELECT * FROM supplier WHERE supplierID = '.$row["CapSupplier"].'';
			$rs2 = $db->query($sql3);
			$row2 = $rs->fetch();
			$row3 = $rs2->fetch();
			
		 	$i ++;	
           $output[] = '<td style="padding:0 25px 40px 25px;"><img src="PHPUploaded/cap'.$row['CapID'].'.jpg" width="75" height="75" /><br>Cap Name: '.$row['CapName'].'<br>Category: '.$row2["category"].'<br>Supplier: '.$row3['supplierName'].'<br>Price: $'.$row['CapPrice'].'<br><a href="index.php?action=add&id='.$row['CapID'].'&content_page=cart">Add to cart</a></td>';	
		   if($i==4){
		 	$output[] = "</tr><tr>";
			$i = 0;
		   
		   }
      
		}
		 
		$output[] = '</table>';
		echo join('',$output);
}
}

?>
