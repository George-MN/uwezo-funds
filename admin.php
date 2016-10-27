<?php?>
<html>
<head>
<title>uwezo fund application and allocation </title>
<link rel="stylesheet" type="text/css" href="uwezo/applicant.css">
<script type="text/javascript" src="jquery-2.1.1.js"></script>
<script src="jquery.js"></script>
<script src="jquery.cycle2"></script>
</head>
<body>
<div id="myhead">
<div class="logos">
  <ul class="picts">
	<li id="navig"><img src="uwezo.png" align="center"></li>
	<li id="navig"></li>
	<li id="navig"></li>
	<li id="navig"></li>
	<li id="navig"></li>
	<li id="navig"></li>
	<li id="navig"class="govt"><img src="govt.png" align="center"></li>
</ul>
</div>
	<div class="head">
	<ul>
	    <li id="navig"></li>
		<li id="navig"class="home"><a  href="#">APPROVE GROUPS</a></li>
		<li id="navig"class="apply"><a href="#">ALLOCATE FUND</a></li>
		<li id="navig"class="about"><a href="#">UNALLOCATED GROUPS</a></li>
		<li id="navig"class="contact"><a href="#">ASSESSMENT</a></li>
		<li id="navig"class="login"><a href="#">ALLOCATED GROUPS</a></li>
		<?php 
           if (isset($_SESSION['category']) && $_SESSION['category']==1) {
             	echo "<li id='navig'class='login'><a href='#'>DELETE GROUPS</a></li>";
             }  
           

		?>
		<li id="navig" class="login"><?php 
		session_start();
    if(isset($_SESSION['group_name']))
    {   
        echo ' <a href ="logout.php">SIGN-OUT</a>';
        
    }
    else
    {
        echo 'LOGIN';
    }?>
    </li>
     