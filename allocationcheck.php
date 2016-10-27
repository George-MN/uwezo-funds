<?php
include"applicants.html";
include "connect.php";
if (isset($_SESSION['group_name']) && isset($_SESSION['reg_no']) && isset($_SESSION['address'])){

	$registration=$_SESSION['reg_no'];
	$query="select loan_no from loan
	        where(reg_no='$registration')";
	  $loan=mysqli_query($conn,$query);
	  if(!$loan){
	  	echo "database error";
	  }
	  else{
	  	$row=mysqli_fetch_assoc($loan);
	  	$myloan=$row['loan_no'];


	  	if(!empty($row)){
	  		$query2="select status,
	  		                amount_allocated,
	  		                reason,
	  		                repayment_time
	  		         from allocations
	  		         where(loan_no='$myloan')";

	  		         $queryresult=mysqli_query($conn,$query);

	  		     if (!$queryresult) {
	  		     	echo "database error 2";
	  		       }
	  		     else {
	  		     	echo '<table border="1" padding="10px" align="center" class="alloctable">';
	  		     	echo "<tr>";
	  		     	echo "<th>GROUP NAME</th>";
	  		     	echo "<th>REG. NO</th>";
	  		     	echo "<th>AMOUNT GIVEN</th>";
	  		     	echo "<th>REASON</th>";
	  		     	echo "<th>REPAYMENT PERIOD</th>";
	  		     	echo "</tr>";

	  		     	while($row=mysqli_fetch_assoc($queryresult)){
	  		     		if(isset($row['amount_allocated']) && isset($row['reason']) && isset($row['repayment_time'])){
	  		     		echo "<tr>";
	  		     		echo "<td>";
	  		     		echo $_SESSION['group_name'];
	  		     		echo "</td>";
	  		     		echo "<td>";
	  		     		echo $_SESSION['reg_no'];
	  		     		echo "</td>";
	  		     		echo "<td>";
	  		     		echo $row['amount_allocated'];
	  		     		echo "</td>";
	  		     		echo "<td>";
	  		     		echo $row['reason'];
	  		     		echo "</td>";
	  		     		echo "<td>";
	  		     		echo $row['repayment_time'];
	  		     		echo "</td>";
	  		     		echo "<tr>";

	  		     	}
                      
	  		     	}
	  		     	echo "</table>";

	  		     }
	  	}
	  }
}


?>