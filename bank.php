<?php
include"applicants.html";
include "connect.php";
if ($_SERVER['REQUEST_METHOD']=='POST') {
	 if(isset($_POST['bank']) && isset($_POST['acc_no']) && isset($_POST['branch']) && isset($_POST['amount']) && $_FILES['statement']['size']>0){
    $registration=$_SESSION['reg_no'];
    $bank=mysql_real_escape_string($_POST['bank']);
    $account=mysql_real_escape_string($_POST['acc_no']);
    $branch=mysql_real_escape_string($_POST['branch']);
    $amount=mysql_real_escape_string($_POST['amount']);
    $size=intval($_FILES['statement']['size']);
	$type=mysql_real_escape_string($_FILES['statement']['type']);
	$content=mysql_real_escape_string(file_get_contents($_FILES['statement'])['tmp_name']);

	 	$bankdetails="insert into bank_details(reg_no,bank_name,account,branch,account_amount,size,type,content)
	 	             values('$registration','$bank','$account','$branch','$amount','$size','$type','$content')";
	 	$bankresults=mysqli_query($conn,$bankdetails);
	 	if(!$bankdetails){
	 		echo "database";
	 	}
	 	else{
	 		header("location: loan.php");
	 	}
	 }
}
if (isset($_SESSION['group_name']) && isset($_SESSION['reg_no']) && isset($_SESSION['address'])){
	$reg_no=$_SESSION['reg_no'];
	$myquery="SELECT bank_name,
	                 account,
	                 branch
	           FROM bank_details
	           WHERE(reg_no='$reg_no')";
	          $myqueryresult=mysqli_query($conn,$myquery);
	          if (!$myqueryresult) {
	          	echo "database error";
	          }
	          else{
	          	$row=mysqli_fetch_array($myqueryresult);
	          	if(!empty($row)){
	          		header("location: loan.php");
	          	}
	    else{
	echo "<html>
	<head>
		<title>
			uwezo bank details
		</title>
		<script type='text/javascript'></script>
		
	</head>
	<body>
		<div class='bank'>
			<p class='instructions'>fill in all the details in this field</p></br>
			<label>step 4 of 5</label>
			<fieldset>
				<legend>Bank details</legend>
				<form method='post' action='' enctype='multipart/form-data'>
				Bank name: <input type='text' name='bank' placeholder='bankname'><span> </span>
				Account number: <input type='text' name='acc_no' placeholder='account number'><span></span>
				Branch: <input type='text' name='branch' placeholder='branch'><span></span>
				Amount in bank: <input type='text' name='amount' placeholder='amount'><span> </span></br></br>
				<p class='instructions'>please attach the bank statement below</p></br></br>
				<input type='hidden' name='MAX_FILE_SIZE' value='2000000'>
                <input name='statement' type='file' id='userfile'><span></span></br>
                <input type='submit' value='next step'>

				</form>
			</fieldset>
		</div>
	</body>
</html>";
}
}
}
else{
	echo "you have to login first to continue";
}
?>
