 <?php
// create connection
$mysqli = new mysqli("localhost", "leroyt01", "21021994", "leroyt01mysql1");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>
    <script src="WABootstrap/bootstrap.js" type="text/javascript">
	</script>
     <script src="WABootstrap/jquery-1.10.2.js" type="text/javascript">
	</script>
    <script src="WABootstrap/modernizr-2.6.2.js" type="text/javascript">
	</script>
    <script src="WABootstrap/respond.js" type="text/javascript">
	</script>
    
<!-- Navigation bar-->
<title>Cap</title>

    <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
    <!--Collapse button-->
    <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" runat="server" href="index.php?content_page=product">Home</a>
    </div>
    <!--links-->
    <div class="navbar-collapse collapse">
    <ul class="nav navbar-nav">
    <?php
		//Select the file information
$sql="SELECT category.cate_id As Cate_ID,
              category.category As Category
      FROM category ";
	  
$rs=$mysqli->query($sql);
if (!$rs)
  {exit("Error in SQL");}


while ($row = $rs->fetch_assoc())
{
  $cate_id=$row["Cate_ID"];
  $cate=$row["Category"];
  echo '<li><a runat="server" href="index.php?cate='.$cate_id.'&content_page=product">'.$cate.'</a></li>';

}
	?>
    
    <li><a runat="server" href="index.php?content_page=WAContactUs">ContactUs</a></li>
    </ul>
    <ul class="nav navbar-nav pull-right">
    <li><a runat="server" href="index.php?content_page=cart">Cart<span style="font-size:11px; padding:2px 4px; background-color:blue; color:white; border-radius:10px"><?php session_start(); echo $_SESSION['itemCount']; ?></span></a></li>
    <li><a runat="server" href="index.php?content_page=register">Register</a></li>
    
    <?php session_start();  
	function logout(){
		$_SESSION['AdminLogged'] = false;
		$_SESSION['Logged'] = false;
	}
	if (isset($_GET['logout'])) {
    	logout();
		header("Location: index.php?content_page=product");
  	}
	if($_SESSION['Logged'] == true) {echo '<li><a runat="server" href="index.php?logout=true">Logout</a></li>'; echo '<li><a runat="server" href="index.php?content_page=order">Welcome! ' .$_SESSION["uname"].'</a></li>';}
	else{
			echo '<li><a runat="server" href="index.php?content_page=login">Login</a></li>';
		}
	
	 ?>
    </ul>
    </div>
    </div>
    </div>    
    
 <div id="header">
 <div id="logo" onClick="location.href='index.php?content_page=product'">
 </div>
 </div>
 <!-- The body area -->
 <div id="left" class="col-md-2"> <?php session_start(); if($_SESSION['AdminLogged'] == true) include('Menu.php');?></div>
<div id="right" class="col-md-10"> <?php include($page_content);?> </div>
 
<!-- Footer -->
  <div style="position: fixed; bottom: 0px; left:0px;">
      <!-- Call javascript function -->
  <script type="text/javascript">
      current_time();
  </script>
  </div>
  <div style="position: fixed; bottom: 0px; right:0px;">
  &copy;2016 - Quality Caps
</div>
