<?php
session_start();
session_destroy();
header("location: home.php");
/*session_destroy($_SESSION['group_name']);
session_destroy($_SESSION['reg_no']);
session_destroy($_SESSION['address']);
if(empty($_SESSION['group_name']) && empty($_SESSION['reg_no']) && empty($_SESSION['address'])){
	header("location: home.php");
}
else{
	echo "unsuccessful";
}*/



?>