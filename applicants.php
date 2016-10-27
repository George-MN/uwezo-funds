<?php
include "applicants.html";
//session_start();

if (isset($_SESSION['group_name']) && isset($_SESSION['reg_no']) && isset($_SESSION['address'])) {
	 echo "<p class='Welcome'>";
	 echo "Welcome ";
	 echo $_SESSION['group_name'];
	 echo "</br>You can apply for the uwezo fund online now and wait for the allocation";
     echo "</p>";

}
else{
	echo "<span class='error'>you have to login first in order to view</span>";
}
?>
