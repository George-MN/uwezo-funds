<?php
include"applicants.html";
include "connect.php";
if (isset($_SESSION['group_name']) && isset($_SESSION['reg_no']) && isset($_SESSION['address'])){
  $reg_no=$_SESSION['reg_no'];
  $myquery="SELECT status 
            from applicants_det
            where(group_reg_no='$reg_no')";

         $results=mysqli_query($conn,$myquery);
         if (!$results) {
         	echo "database error";
         }
         else{
         
         $results2=mysqli_fetch_assoc($results);
          if($results2==1){
          	echo "<p class='Welcome'>";
         	echo "your application has been processeed.check for allocations";
         	echo "</p>";


         }
         else  {
         	echo "<p class='Welcome'>";
         	echo "your request has not been processed. ";
         	echo "</p>";
         }
         
     }


}
else{
	echo "<p class='Welcome'>";
	echo "you have to login first in order to proceed";
	echo "</p>";
}


?>