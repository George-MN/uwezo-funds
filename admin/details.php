<?php
session_start();
include "admin.html";
include "connect.php";

$myid=mysql_real_escape_string($_GET['reg_no']);


?>