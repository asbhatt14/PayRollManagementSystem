<?PHP
include("DBManager.php");

$employee = new Employee;

$employee->tempConnection();

$name = $rdo1Chcked=$rdo2Chcked=$gender="";
$dateOfBirth = $address = $city = $province = $postalCode="";
$empEmail = $empLinkedIn = $dateOfJoining = $annualPay ="";
$errName = $errGender = $errDOB = $errAddress = $errCity = $errProvince = $errPostalCode = $errEmail= $errURL= $errJoiningDate="";
$errAnnualPay = "";
$valid = true;

if($_SERVER["REQUEST_METHOD"] == "POST"){

//			VALUES ('$this->name', '$this->gender','$this->email','$this->url','$this->dob','$this->address','$this->city','$this->province','$this->zipcode','$this->joinDate','$this->basicPay')";

	if(isset($_POST["empName"])){
		$name = $_POST["empName"];
		$employee->setName($name);
	}
	if(empty($_POST["empName"])){
		$errName="Please enter name";
		$valid = false;
	}

	if(isset($_POST["gender"])){
		$gender = $_POST["gender"];
		$employee->setGender($gender);
		if($_POST["gender"]=="Male"){
			$rdo1Chcked = "Checked";
		}elseif($_POST["gender"]=="Female"){
			$rdo2Chcked = "Checked";
		}
	}else{
		$errGender = "Please select any option";
		$valid = false;
	}

	/*if(isset($_POST["empEmail"])){
		$empEmail = $_POST["empEmail"];
		$employee->setEmail($empEmail);
	}*/

	if(isset($_POST["empEmail"])){
		if (!filter_var($_POST["empEmail"], FILTER_VALIDATE_EMAIL)) {
			$errEmail = "Invalid email format";
			$valid = false;
		  }else{
			$empEmail = $_POST["empEmail"];
			$employee->setEmail($empEmail);
		  }
		
	}

	if(empty($_POST["empEmail"])){
		$errEmail="Please enter Email";
		$valid = false;
	}

	/*if(isset($_POST["empLinkedIn"])){
		$empLinkedIn = $_POST["empLinkedIn"];
		$employee->setUrl($empLinkedIn);
	}*/

	if(isset($_POST["empLinkedIn"])){
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$_POST["empLinkedIn"])) {
			$errURL = "Invalid URL";
			$valid = false;
		  }else{
			$empLinkedIn = $_POST["empLinkedIn"];
			$employee->setUrl($empLinkedIn);
		  }
		
	}

	if(empty($_POST["empLinkedIn"])){
		$errURL="Please enter Url";
		$valid = false;
	}

	if(isset($_POST["dateOfBirth"])){
		$dateOfBirth = $_POST["dateOfBirth"];
		$employee->setDob($dateOfBirth);
	}
	if(empty($_POST["dateOfBirth"])){
		$errDOB="Please enter Date Of Birth";
		$valid = false;
	}

	if(isset($_POST["address"])){
		$address = $_POST["address"];
		$employee->setAddress($address);
	}
	if(empty($_POST["address"])){
		$errAddress="Please enter Street Address";
		$valid = false;
	}

	if(isset($_POST["city"])){
		$city = $_POST["city"];
		$employee->setCity($city);
	}
	if(empty($_POST["city"])){
		$errCity="Please enter City";
		$valid = false;
	}

	if(isset($_POST["province"])){
		$province = $_POST["province"];
		$employee->setProvince($province);
	}
	if(empty($_POST["province"])){
		$errProvince="Please enter Province";
		$valid = false;
	}

	if(isset($_POST["postalCode"])){
		$postalCode = $_POST["postalCode"];
		$employee->setZipcode($postalCode);
	}
	if(empty($_POST["postalCode"])){
		$errPostalCode="Please enter Postl Code";
		$valid = false;
	}

	if(isset($_POST["dateOfJoining"])){
		$dateOfJoining = $_POST["dateOfJoining"];
		$employee->setJoiningDate($dateOfJoining);
	}
	if(empty($_POST["dateOfJoining"])){
		$errJoiningDate="Please enter Joining Date";
		$valid = false;
	}

	if(isset($_POST["annualPay"])){
		$annualPay = $_POST["annualPay"];
		$employee->setBasicpay($annualPay);
	}
	if(empty($_POST["annualPay"])){
		$errAnnualPay="Please enter Annual Pay";
		$valid = false;
	}
	if($valid){
		$employee->insertEmployee();
		header('Location: index.php');
		exit();
	}
	
	
	
}

?>
<!DOCTYPE HTML>
<html>

<!-- Mirrored from p.w3layouts.com/demos/easy_admin_panel/web/forms.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Sep 2017 16:40:31 GMT -->
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
   
 <body class="sticky-header left-side-collapsed" >
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
								<li ><a href="index.php"><i class="lnr lnr-power-switch"></i><span>Home</span></a></li>
								
								<li class="menu-list"><a href="forms.php"><i class="lnr lnr-pencil"></i> <span>Manage Employees</span></a>
									<ul class="sub-menu-list">
										<li class="active"><a href="forms.php">Add Employee</a> </li>
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
		<div class="main-content main-content3">
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
					<h3 class="blank1">Employee Details</h3>

						<div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Employee Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="empName" id="empName" placeholder="Employee Name" value="<?php echo htmlspecialchars($name)?>">
									</div>
									<div class="col-sm-2 jlkdfj1">
										<p class="help-block"><?php echo ($errName);?></p>
									</div>
								</div>
								<div class="form-group">
									<label for="radio" class="col-sm-2 control-label">Gender</label>
									<div class="col-sm-8">
										<div class="radio block"><label><input type="radio" name="gender" value="Male" <?php echo htmlspecialchars ($rdo1Chcked);?>> Male</label></div>
										<div class="radio block"><label><input type="radio" name="gender" value="Female" <?php echo htmlspecialchars ($rdo2Chcked);?>> FeMale</label></div>
									</div>
									<div class="col-sm-2 jlkdfj1">
										<p class="help-block"><?php echo ($errGender);?></p>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Date of Birth</label>
									<div class="col-sm-8">
										<input type="date" class="form-control1" name="dateOfBirth" id="dateOfBirth" placeholder="YYYY-MM-DD" value="<?php echo htmlspecialchars($dateOfBirth)?>" 
										max=<?php
												echo date('Y-m-d',strtotime('-18 years'));
											?>>
									</div>
									<div class="col-sm-2 jlkdfj1">
										<p class="help-block"><?php echo ($errDOB);?></p>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Street Address</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="address" id="address" placeholder="Street Address" value="<?php echo htmlspecialchars($address)?>">
									</div>
									<div class="col-sm-2 jlkdfj1">
										<p class="help-block"><?php echo ($errAddress);?></p>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">City</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="city" id="city" placeholder="City" value="<?php echo htmlspecialchars($city)?>">
									</div>
									<div class="col-sm-2 jlkdfj1">
										<p class="help-block"><?php echo ($errCity);?></p>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Province</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="province" id="province" placeholder="Province" value="<?php echo htmlspecialchars($province)?>">
									</div>
									<div class="col-sm-2 jlkdfj1">
										<p class="help-block"><?php echo ($errProvince);?></p>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Postal Code</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="postalCode" id="postalCode" placeholder="Postal Code" value="<?php echo htmlspecialchars($postalCode)?>">
									</div>
									<div class="col-sm-2 jlkdfj1">
										<p class="help-block"><?php echo ($errPostalCode);?></p>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Email Address</label>
									<div class="col-sm-8">
										<input type="email" class="form-control1" name="empEmail" id="empEmail" placeholder="abc@gmail.com" value="<?php echo htmlspecialchars($empEmail)?>">
									</div>
									<div class="col-sm-2 jlkdfj1">
										<p class="help-block"><?php echo ($errEmail);?></p>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">LinkedIn URL</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="empLinkedIn" id="empLinkedIn" placeholder="Employee LinkedIn Profile URL" value="<?php echo htmlspecialchars($empLinkedIn)?>">
									</div>
									<div class="col-sm-2 jlkdfj1">
										<p class="help-block"><?php echo ($errURL);?></p>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Joining Date</label>
									<div class="col-sm-8">
										<input type="date" class="form-control1" name="dateOfJoining" id="dateOfJoining" placeholder="YYYY-MM-DD" value="<?php echo htmlspecialchars($dateOfJoining)?>"
										max=<?php
												echo date('Y-m-d',strtotime('-1 month'));
											?>>
									</div>
									<div class="col-sm-2 jlkdfj1">
										<p class="help-block"><?php echo ($errJoiningDate);?></p>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Annual Basic Pay</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="annualPay" id="annualPay" placeholder="AnnualPay" value="<?php echo htmlspecialchars($annualPay)?>">
									</div>
									<div class="col-sm-2 jlkdfj1">
										<p class="help-block"><?php echo ($errAnnualPay);?></p>
									</div>
								</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-sm-8 col-sm-offset-2">
											<button class="btn-success btn">Submit</button>
											<button class="btn-inverse btn">Reset</button>
										</div>
									</div>
								 </div>
							</form>
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

<!-- Mirrored from p.w3layouts.com/demos/easy_admin_panel/web/forms.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Sep 2017 16:40:31 GMT -->
</html>