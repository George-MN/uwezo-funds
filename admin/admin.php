
<html>
<head>
<title>uwezo fund application and allocation </title>
<link rel="stylesheet" type="text/css" href="applicant.css">
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
	<li id="navig"></li>
	<li id="navig"></li>
	<li id="navig"class="govt"><img src="govt.png" align="center"></li>
</ul>
</div>
	<div class="head">
	<ul>
	    <li id="navig"></li>
		<li id="navig"class="home"><a href="#mylist">APPROVE GROUPS</a></li>
		<li id="navig"class="apply"><a href="allocate.php">ALLOCATE FUND</a></li>
		
		<li id="navig"class="contact"><a href="#">ASSESSMENT</a></li>
		<li id="navig"class="login"><a href="#">ALLOCATED GROUPS</a></li>
		<?php 
		session_start();
		if (isset($_SESSION['username']) && isset($_SESSION['category'])) {
			
		
           if (isset($_SESSION['category']) && $_SESSION['category']=='1') {
             	echo "<li id='navig'class='login'><a href='#'>DELETE GROUPS</a></li>";
           }

               
           xdebug.va

		?>
		<li id="navig" class="login"><?php 
		
    if(isset($_SESSION['username']))
    {   
        echo ' <a href ="logout.php">SIGN-OUT</a>';
        
    }
    else
    {
        echo 'LOGIN';
    }?>
    </li>
     </ul>
	</div>

	</div>
	<div align="center" id="mylist">
		<?php
		include "connect.php";
		$comf=1;
      
      $queries="select applicants_det.group_name,
                       applicants_det.group_reg_no,
                       applicants_det.period_existed,
                       applicants_det.group_identity,
                       applicants_det.status,
                       bank_details.account_amount,
                       bank_details.reg_no
                from bank_details
                LEFT join applicants_det
                on
                    applicants_det.group_reg_no=bank_details.reg_no
                where 
                (applicants_det.confirmation='$comf')";
                
                $results=mysqli_query($conn,$queries);
                if(!$results){
                	echo "database error";
                }
                else if (mysqli_num_rows($results)==0) {
                	echo "no applications yet";

          }
                else{
                	echo '<table class="table" border="1">
         
                      <tr>
                        <th>GROUP NAME</th>
                        <th>REGISTRATION NO.</th>
                        <th>PERIOD EXISTED</th>
                        <th>IDENTITY</th>
                        <th>CONTRIBUTION</th>
                        <th>MORE DETAILS</th>
                        <th>APPROVE</th>
                      </tr>';
                      while ($row=mysqli_fetch_assoc($results)) {
                      	echo "<tr>";
                      	echo "<td>";
                      	echo $row['group_name'];
                      	echo "</td>";
                      	echo "<td>";
                      	echo $row['reg_no'];
                      	$reg_no=$row['reg_no'];
                      	echo "</td>";
                      	echo "<td>";
                      	echo $row['period_existed'];
                      	echo "</td>";
                      	echo "<td>";
                      	echo $row['group_identity'];
                      	echo "</td>";
                      	echo "<td>";
                      	echo $row['account_amount'];
                      	echo "</td>";
                      	echo "<td>";

                      	echo '<a href="details.php?id=' . $row['reg_no'];
                      	echo ">more details</a>";
                      	echo "</td>";
                      	echo "<td>";
                      	if ($row['status']==1) {
                      		if($_SESSION['category']==1){
                      		echo "<a href='disaprove.php'>DISAPPROVE</a>";
                      	}
                      	else{
                      		echo "group approved";
                      	}
                      	}
                      	else{
                      		if($_SESSION['category']==1){
                      		echo "<a href='approve.php'>APPROVE</a>";
                      	}
                      	else{
                      		echo "group UNAPPROVED";
                      	}

                      	}
                      	
                      	echo "</td>";

                      }

                }
            }

		?>
       

	</div>

</body>
