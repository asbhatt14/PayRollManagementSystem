<?PHP
	include("db_connect.php");
	$user_name = $password = "";
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$user_name=$_POST['userName'];
		$password=$_POST['password'];

		$sql = "SELECT * FROM LogIn WHERE username = '$user_name' and password = '$password'";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) >= 1) {
			//session_register("myusername");
			//$_SESSION['login_user'] = $myusername;
			
			header("location: index.php");
			exit();
		 }else {
			$error = "Your Login Name or Password is invalid";
		 }
	  }
?>	
<!DOCTYPE HTML>
<html>

<!-- Mirrored from p.w3layouts.com/demos/easy_admin_panel/web/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Sep 2017 16:40:31 GMT -->
<head>
<title>PayRoll Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!----webfonts--->
<link href='http://fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<!---//webfonts---> 
 <!-- Meters graphs -->
<script src="js/jquery-1.10.2.min.js"></script>
<!-- Placed js at the end of the document so the pages load faster -->

</head> 
   
 <body class="sign-in-up">
    <section>
			<div id="page-wrapper" class="sign-in-wrapper">
				<div class="graphs">
					<div class="sign-in-form">

						<div class="sign-in-form-top">
							<p><span>Sign In to</span> System</p>
						</div>
						<div class="signin">

							<form action="" method="post">
							<div class="log-input">
								<div class="log-input-left">
								   <input type="text" class="user" value="<?php echo htmlspecialchars($user_name)?>" name="userName" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'UserName';}"/>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="log-input">
								<div class="log-input-left">
								   <input type="password" class="lock" value="<?php echo htmlspecialchars($password)?>" name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'UserName';}"/>
								</div>
								<div class="clearfix"> </div>
							</div>
							<input type="submit" value="Login" name="login">
						</form>	 
						</div>


					</div>
				</div>
			</div>
		<!--footer section start-->
			<footer>
			<p>&copy 2015. All Rights Reserved | Design by <a href="" target="_blank">ABinc.</a></p>
			</footer>
        <!--footer section end-->
	</section>
	
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
</body>

<!-- Mirrored from p.w3layouts.com/demos/easy_admin_panel/web/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Sep 2017 16:40:31 GMT -->
</html>