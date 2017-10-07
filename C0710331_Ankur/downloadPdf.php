<?php
session_start();
$errName = "";
$empId="";
$empName ="";


$monthlyPay= $pre_month = $daysInMonth = $month = $time ="";
$tax = "";
$finalAmount = "";

$annualPay = "";


 $empId = $_SESSION["empID"] ;
 $empName = $_SESSION["empName"] ;
 $daysInMonth = $_SESSION["daysInMonth"];
 $dateValue = $_SESSION["dateValue"];
 $annualPay = $_SESSION["annualPay"];
 $tax = $_SESSION["tax"];
 $monthlyPay = $_SESSION["monthlyPay"];
 $finalAmount = $_SESSION["finalAmount"];


?>
<html>
    <head>
        <title>PDF</title>
    </head>
    <body>
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
            <td class="text-right">Tax Year:<input type="hidden" name="taxyear"></td>
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
</div>

</div>    
    </body>
</html>