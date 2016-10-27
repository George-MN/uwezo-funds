<?php
include"applicants.html";
include "connect.php";
if (isset($_SESSION['group_name']) && isset($_SESSION['reg_no']) && isset($_SESSION['address'])) {
	
	 $regno=$_SESSION['reg_no'];
	$myquery3="select project_no,
	                  project_type
	          from project
	          where(reg_no='$regno')";

$myquery3results=mysqli_query($conn,$myquery3);
	if(!$myquery3results){
		echo "database error3";
	}
	else{
		 $prow=mysqli_fetch_assoc($myquery3results);
         $pnumber=$prow['project_no'];
         $ptype=$prow['project_type'];

         $assmquery="select recommendation
                     from assessment
                     where(project_no='$pnumber')";

         $checkresults=mysqli_query($conn,$assmquery);
         if (!$checkresults) {
         	echo "database error";
         }
         else{
         	$myrowr=mysqli_fetch_assoc($checkresults);
            $myrow=$myrowr['recommendation'];

         	if(!empty($myrow)){

         		echo "<table>";
         		echo "<tr>";
	           	echo "<th>GROUP NAME</th>";
	           	echo "<th>REG NO.</th>";
	           	echo "<th>PROJECT TYPE</th>";
	           	echo "<th>RECOMMENDATION</th>";
	           	echo "</tr>";
	           	echo "<tr>";
	           	echo "<td>";
	           	echo $_SESSION['group_name'];
	           	echo "</td>";
	           	echo $_SESSION['reg_no'];
	           	echo "</td>";
	           	echo "<td>";
	           	echo $ptype;
	           	echo "</td>";
	           	echo "<td>";
	           	echo $myrow;
	           	echo "</td>";
	           	echo "</tr>";

         	}
         	else{
         		echo "<p class='Welcome'>";
         		echo "assessment details are not yet processed";
         		echo "</p>";

         	}
         }
     }
}



?>