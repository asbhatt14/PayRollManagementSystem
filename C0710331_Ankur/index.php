<?PHP
include("DBManager.php");

$employee = new Employee;
//Comment this code After connection has been established, Database Created and Record Inserted
$employee->createConection();
$employee->createTable();
$employee->insertEmployee();
//Comment this code After connection has been established, Database Created and Record Inserted

$employee->tempConnection();

$sql = "SELECT * FROM Employee";
$result = mysqli_query($employee->conn1, $sql);

?>
<!DOCTYPE HTML>
<html>

<!-- Mirrored from p.w3layouts.com/demos/easy_admin_panel/web/tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Sep 2017 16:40:16 GMT -->
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
   
 <body class="sticky-header left-side-collapsed">
    <section>
    <!-- left side start-->
		<div class="left-side sticky-left-side">
			
						<!--logo and iconic logo start-->
						<div class="logo">
							<h1><a href="index.php">PayRoll <span>System</span></a></h1>
						</div>
						<div class="logo-icon text-center">
							<a href="index.php"><i class="lnr lnr-home"></i> </a>
						</div>
			
						<!--logo and iconic logo end-->
						<div class="left-side-inner">
			
							<!--sidebar nav start-->
								<ul class="nav nav-pills nav-stacked custom-nav">
									<li class="active"><a href="index.php"><i class="lnr lnr-power-switch"></i><span>Home</span></a></li>
									
									<li class="menu-list"><a href="forms.php"><i class="lnr lnr-pencil"></i> <span>Manage Employees</span></a>
										<ul class="sub-menu-list">
											<li><a href="forms.php">Add Employee</a> </li>
											<li><a href="editForms.php">Update Employee</a></li>
											
										</ul>
									</li>
									<li ><a href="payStub.php"><i class="lnr lnr-cog"></i> <span>Generate Pay Stub</span></a></li>
									
								</ul>
							<!--sidebar nav end-->
						</div>
					</div>
    <!-- left side end-->
    
    <!-- main content start-->
		<div class="main-content main-content4">
			<!-- header-starts -->
			<div class="header-section">
			 
			<!--toggle button start-->
			<a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
			<!--toggle button end-->

			<!--notification menu start -->
			<div class="menu-right">
				<div class="user-panel-top">  	
					<div class="profile_details_left">
					</div>
					<div class="profile_details">		
						<ul>
							<li class="dropdown profile_details_drop">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<div class="profile_img">	
										<span style="background:url(images/3.png) no-repeat center"> </span> 
										 <div class="user-name">
											<p>Michael<span>Administrator</span></p>
										 </div>
										 <i class="lnr lnr-chevron-down"></i>
										 <i class="lnr lnr-chevron-up"></i>
										<div class="clearfix"></div>	
									</div>	
								</a>
								<ul class="dropdown-menu drp-mnu">
									<li> <a href="sign-in.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
								</ul>
							</li>
							<div class="clearfix"> </div>
						</ul>
					</div>		
					            	
					<div class="clearfix"></div>
				</div>
			  </div>
			<!--notification menu end -->
			</div>
	<!-- //header-ends -->
			<div id="page-wrapper">
				<div class="graphs">
					<h3 class="blank1">Employee List</h3>

					 <div class="xs tabls">
						<div class="bs-example4" data-example-id="contextual-table">
						<table class="table">
						  <thead>
							<tr>
							  <th>Id</th>
							  <th>Employee Name</th>
								<th>Emolyee Email</th>
								<th>Joinig Date</th>
							  <th>Annual Pay</th>
							</tr>
						  </thead>
						  <tbody>
							 <?php
							 if(mysqli_num_rows($result) > 0) {
								 while($row=mysqli_fetch_assoc($result)){

									?>
								<tr class="success">
								<td><?php echo $row['id']; ?></td> 
								<td><?php echo $row['name']; ?></td> 
								<td><?php echo $row['email']; ?></td> 
								<td><?php echo $row['joinDate']; ?></td> 	
								<td><?php echo $row['basicPay']; ?></td> 	
							</tr>
							<?php				 
								 }
							 }
							 ?>

						  </tbody>
						</table>
					   </div>

	
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

<!-- Mirrored from p.w3layouts.com/demos/easy_admin_panel/web/tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Sep 2017 16:40:22 GMT -->
</html>