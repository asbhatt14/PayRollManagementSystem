<?PHP
session_start();
include("DBManager.php");
require('phpToPDF.php');
$employee = new Employee;

$employee->tempConnection();

$errName = "";
$empId="";
$empName = $fileName ="";


$monthlyPay= $pre_month = $daysInMonth = $month = $time ="";
$tax = $year= $dateValue = "";
$finalAmount = "";

$annualPay = "";
$roundedAnnualPay = $roundedTax = $roundedMonthlyPay = $roundedFinalAmount = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST["empId"])){
		$empId = $_POST["empId"];
		//$employee->setName($name);
	}
	if(empty($_POST["empId"])){
		$errName="Please Enter Employee Id";
		$valid = false;
    }
    
    $sql="SELECT * FROM employee WHERE id = '".$empId."'";
    $result = mysqli_query($employee->conn1,$sql);	

    if(mysqli_num_rows($result) > 0) {
        while($row=mysqli_fetch_assoc($result)){
            $annualPay = $row['basicPay'];
            $empId = $row['id'];
            $empName = $row['name'];
       }
    }


    $monthlyPay = ($annualPay/12);
    if($annualPay<=45916){
        $tax =  ($monthlyPay * 15)/100; 
    }else if($annualPay>45916 && $annualPay <=91831 ){
        $tax =  ($monthlyPay * 20.5)/100; 	
    }else if($annualPay>91831 && $annualPay <=142353){
        $tax =  ($monthlyPay * 26)/100; 
    }else if($annualPay>142353 && $annualPay <=202800){
        $tax =  ($monthlyPay * 29)/100; 
    }else{
        $tax =  ($monthlyPay * 33)/100; 
    }
    $finalAmount= $monthlyPay - $tax;

    $dateValue = date("Y/m/d");
    
    $time=strtotime($dateValue);
    $month=date("F",$time);

    $pre_month = strtoupper(date ("m",strtotime($month . " last month")));
    $year = strtoupper(date ("Y",strtotime($month . " last month")));

    $daysInMonth = cal_days_in_month(CAL_GREGORIAN,$pre_month,$year);

    $_SESSION["empID"] = $empId;
    $_SESSION["empName"] = $empName;
    $_SESSION["daysInMonth"] = $daysInMonth;
    $_SESSION["dateValue"] = $dateValue;
    $_SESSION["annualPay"] = $annualPay;
    $_SESSION["tax"] = $tax;
    $_SESSION["monthlyPay"] = $monthlyPay;
    $_SESSION["finalAmount"] = $finalAmount;

}

?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){


    if (isset($_POST['download'])) {
        $empId = $_POST["empIdTemp"] ;
        $empName = $_POST["empName"] ;
        $daysInMonth = $_POST["daysInMonth"];
        $dateValue = $_POST["dateValue"];
        $annualPay = $_POST["annualPay"];
        $tax = $_POST["tax"];
        $monthlyPay = $_POST["monthlyPay"];
        $finalAmount = $_POST["finalAmount"];
        $roundedAnnualPay = round($annualPay,2);
        $roundedTax = round($tax,2);
        $roundedMonthlyPay=round($monthlyPay,2);
        $roundedFinalAmount = round($finalAmount,2);

        ob_start();
       // include('downloadPdf.php');
        $my_html = "<html lang=\"en\">
        <head>
          <meta charset=\"UTF-8\">
          <title>Sample Invoice</title>
          <link rel=\"stylesheet\" href=\"http://phptopdf.com/bootstrap.css\">
          <style>
            @import url(http://fonts.googleapis.com/css?family=Bree+Serif);
            body, h1, h2, h3, h4, h5, h6{
            font-family: 'Bree Serif', serif;
            }
          </style>
        </head>
        <body>
        <div id=\"paySlipTable\">
        
        <div class=\"col-md-5\"></div>
            <div class=\"col-md-7\">
                <div style=\"height: 50px\"></div>
    
    </div>
    
    <div class=\"col-md-2\"></div>
    <div class=\"col-md-9\">
        <div style=\"height: 20px\"></div>
        <table class=\"table table-striped\" border=\"2\">
            <tr >
                <td colspan=\"2\" class=\"text-center\">
                    <b>PaySlip</b>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class=\"text-right\">Tax Year:$year</td>
            </tr>
            <tr>
                <td>Employee Code: &nbsp; $empId</td>
                <td>Pay Period: &nbsp; $daysInMonth</td>
            </tr>
            <tr>
                <td>Employee Name:&nbsp; $empName</td>
                <td>Pay Date: &nbsp;$dateValue</td>
            </tr>
            <tr>
                <td>
                    <table class=\"table table-hover\">
                        <tbody>
                        <tr>
                            <th>Earnings</th>
                            <th>Amount</th>
                        </tr>
                        <tr>
                            <td>Basic pay</td>
                            <td>$roundedAnnualPay</td>
                        </tr>
                        
                        </tbody>
                        </td></table>
                <td>
                    <table class=\"table table-hover\">
                        <thead></thead>
                        <tbody>
                        <tr>
                            <th>Deductions</th>
                            <th>Amount</th>
                        </tr>
                        
                        <tr>
                            <td>Tax</td>
                            <td>$roundedTax</td>
                        </tr>
                        </tbody>
                    </table>
    
                </td>
            </tr>
            <tr>
                <td>
                    <table class=\"table table-hover\">
                        <thead>Amount Paid</thead>
                        <tbody>
                        <tr>
                            <td>Earnings</td>
                            <td>$roundedMonthlyPay</td>
                        </tr>
                        <tr>
                            <td>Deductions</td>
                            <td>$roundedTax</td>
                        </tr>
                        <tr>
                            <td>Net Pay</td>
                            <td>$roundedFinalAmount</td>
                        </tr>
                        </tbody>
                    </table>
    
                </td>
                <td>
                    <table class=\"table table-hover\">
                        
                        <tbody>
                        <tr>
                            <td>Signature and Stamp</td>
                            <td><input type=\"hidden\" name=\"contibution1\"></td>
                        </tr>
                        </tbody>
                    </table>
    
                </td>
            </tr>
        </table>
    </div>
    </div>        
        </body>
        </html>";
        $fileName = "payslip" . $empName . ".pdf";
        //Set Your Options -- we are saving the PDF as 'my_filename.pdf' to a 'my_pdfs' folder
        $pdf_options = array(
          "source_type" => 'html',
          "source" => $my_html,
          "action" => 'save',
          "save_directory" => '',
          "file_name" => $fileName);
        
        //Code to generate PDF file from options above
        phptopdf($pdf_options);
        echo "<script type='text/javascript'>alert('PDF Downloaded successfully!')
        document.location='index.php'</script>";
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
										<li ><a href="forms.php">Add Employee</a> </li>
										<li><a href="editForms.php">Update Employee</a></li>
										
									</ul>
								</li>
								<li class="active" ><a href="payStub.php"><i class="lnr lnr-cog"></i> <span>Generate Pay Stub</span></a></li>
								
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
					<h3 class="blank1">Generate Pay Stub</h3>

						<div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Employee Id</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="empId" id="empId" placeholder="Employee Id">
									</div>
									<div class="col-sm-2 jlkdfj1">
										<p class="help-block"><?php echo ($errName);?></p>
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

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div id="paySlipTable">
    
    <div class="col-md-5"></div>
        <div class="col-md-7">
            <div style="height: 50px"></div>

</div>

<div class="col-md-2"></div>
<div class="col-md-9">
    <div style="height: 20px"></div>
    <table class="table table-striped" border="2">
        <tr >
            <td colspan="2" class="text-center">
                <b>PaySlip</b>
            </td>
        </tr>
        <tr>
            <td></td>
            <td class="text-right">Tax Year:<?php echo $year?></td>
        </tr>
        <tr>
            <td>Employee Code: &nbsp; <?php echo $empId?></td>
            <td>Pay Period: &nbsp; <?php echo $daysInMonth?></td>
        </tr>
        <tr>
            <td>Employee Name:&nbsp; <?php echo $empName?></td>
            <td>Pay Date: &nbsp;<?php echo date("Y/m/d")?></td>
        </tr>
        <tr>
            <td>
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>Earnings</th>
                        <th>Amount</th>
                    </tr>
                    <tr>
                        <td>Basic pay</td>
                        <td><?php echo round($annualPay,2)?></td>
                    </tr>
                    
                    </tbody>
                    </td></table>
            <td>
                <table class="table table-hover">
                    <thead></thead>
                    <tbody>
                    <tr>
                        <th>Deductions</th>
                        <th>Amount</th>
                    </tr>
                    
                    <tr>
                        <td>Tax</td>
                        <td><?php echo round($tax,2)?></td>
                    </tr>
                    </tbody>
                </table>

            </td>
        </tr>
        <tr>
            <td>
                <table class="table table-hover">
                    <thead>Amount Paid</thead>
                    <tbody>
                    <tr>
                        <td>Earnings</td>
                        <td><?php echo round($monthlyPay,2)?></td>
                    </tr>
                    <tr>
                        <td>Deductions</td>
                        <td><?php echo round($tax,2)?></td>
                    </tr>
                    <tr>
                        <td>Net Pay</td>
                        <td><?php echo round($finalAmount,2)?></td>
                    </tr>
                    </tbody>
                </table>

            </td>
            <td>
                <table class="table table-hover">
                    
                    <tbody>
                    <tr>
                        <td>Signature and Stamp</td>
                        <td><input type="hidden" name="contibution1"></td>
                    </tr>
                    </tbody>
                </table>

            </td>
        </tr>
    </table>
</div>
<div class=""row>
<div class="col-md-6" align="right"></div>
<div class="col-md-6"><button class="btn-success btn" name="download" value="download">Download</button></div>
<input type="hidden" class="form-control1" name="empIdTemp" id="empIdTemp" value="<?php echo $empId?>">
<input type="hidden" class="form-control1" name="empName" id="empName" value="<?php echo $empName?>">
<input type="hidden" class="form-control1" name="daysInMonth" id="daysInMonth" value="<?php echo $daysInMonth?>">
<input type="hidden" class="form-control1" name="dateValue" id="dateValue" value="<?php echo $dateValue?>">
<input type="hidden" class="form-control1" name="annualPay" id="annualPay" value="<?php echo $annualPay?>">
<input type="hidden" class="form-control1" name="tax" id="tax" value="<?php echo $tax?>">
<input type="hidden" class="form-control1" name="monthlyPay" id="monthlyPay" value="<?php echo $monthlyPay?>">
<input type="hidden" class="form-control1" name="finalAmount" id="finalAmount" value="<?php echo $finalAmount?>">
</div>

</div>
</form>




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