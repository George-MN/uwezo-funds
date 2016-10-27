<?php
include"applicants.html";
include "connect.php";
if ($_SERVER['REQUEST_METHOD']="POST") {
		if(isset($_POST['loan']) && isset($_POST['time'])){
		$registration=$_SESSION['reg_no'];
		$loan=mysql_real_escape_string($_POST['loan']);
		$time=mysql_real_escape_string($_POST['time']);

		$query="insert into loan(reg_no,amount_applied,repayment_period)
		        values('$registration','$loan','$time')";
		$results=mysqli_query($conn,$query);
		if (!$results) {
			echo "database error";
		}
		else{
			header("location: applicants.php");
		}
		}
	}

if (isset($_SESSION['group_name']) && isset($_SESSION['reg_no']) && isset($_SESSION['address'])){
	$reg_no=$_SESSION['reg_no'];
	$myquery="select amount_applied,
	                 repayment_period
	           from loan
	           where (reg_no='$reg_no')";
	           $loanresult=mysqli_query($conn,$myquery);
	           if (!$loanresult) {
	           	echo "database error";
	           }
	           else{
	           	$row=mysqli_fetch_array($loanresult);
	           	if (!empty($row)) {
	           		 echo "<p class='Welcome'>";
	           		echo "you had applied ealier wait for processing or consult your MCA";
	           		echo "</p>";
	           	}
	           	else{

	echo "<html>
	<head>
		<title>
			loan details
		</title>
		
	</head>
	<body>
		<div>
			<p class='instructions'>please fill in all details</p>
			<label>step 5 of 5</label>
			<fieldset>
				<legend>Loan details</legend>
				<form method='post' action=''>
				Amount applying for: <input type='text' name='loan' placeholder='Ksh'required='required'></br></br>
				Repayment period: <input type='text' name='time' placeholder='months'required='required'></br></br>
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
	echo "you have to login first in order to proceed";
}

?>
