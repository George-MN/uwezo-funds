<?php
include "adminheader.php";
include "connect.php";

if(isset($_SESSION['category']) && $_SESSION['category']==1){

$loan=mysql_real_escape_string($_GET['id']);
 if ($_SERVER['REQUEST_METHOD']=='POST') {
 	if(!empty($_POST['amount']) && !empty($_POST['time'])){
 	$amount=$_POST['amount'];
 	$comment=$_POST['comment'];
 	$time=$_POST['time'];
 	$status="allocated";
 	$myquery="select amount_applied,
	                 repayment_period
	           from loan
	           where (loan_no='$loan')";
	           $loanresult=mysqli_query($conn,$myquery);
	           if (!$loanresult) {
	           	echo "database error";
	           }
	           else{
	           	$row=mysqli_fetch_assoc($loanresult);
	           	if (!empty($row)) {

	           	}
	           	else{
	           		$applied=$row['amount_applied'];

	           		if ($amount>$applied) {
	           			echo "amount higher than applied";
	           	}
	           	else if ($amount>500000) {
	           		echo "amount higher than maximum";
	           	}
	           	elseif ($amount<50000) {
	           		echo "amount lower than the minimum";
	           	}
	           	else{
	           		$query1="insert into allocations(loan_no,status,amount_allocated,reason,repayment_time)
	           		         values('$loan','$status','$amount','$comment','$time')";

	           		     $results=mysqli_query($conn,$query1);

	           		     if (!$results) {
	           		     echo "database insertion error";

	           		     }
	           		     else{
	           		     	header("allocate.php");
	           		     }
	           	}

 }


}
}
}

echo "<div align='center' class='amountform'><form  action='' method='POST'>
	AMOUNT <input type='text' name='amount' ></br></br>
	REASON <textarea name='comment' rows='5' cols='40'></textarea></br></br>
	REPAYMENT PERIOD <input type='text' name='time'></br></br>
	<input type='submit' value='save'>
</form></div>";

}
else{
	echo "<span class='error'> you need privileges to continue or login first</span>";
}



?>
