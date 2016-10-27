<?php
include"applicants.html";
include "connect.php";

if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['project']) && isset($_POST['period']) && isset($_POST['status']) && isset($_POST['purpose']) && ($_FILES['proposal']['size']>0)){
    $registration=$_SESSION['reg_no'];
    $project=mysql_real_escape_string($_POST['project']);
    $period=mysql_real_escape_string($_POST['period']);
    $purpose=mysql_real_escape_string($_POST['purpose']);
    $status=mysql_real_escape_string($_POST['status']);
    $size=intval($_FILES['proposal']['size']);
	$type=mysql_real_escape_string($_FILES['proposal']['type']);
	$content=mysql_real_escape_string(file_get_contents($_FILES['proposal'])['tmp_name']);
	$query="insert into project(reg_no,project_type,project_status,existence_period,description,size,type,proposal)
	        values('$registration','$project','$status','$period','$purpose','$size','$type','$proposal')";
 $queryresult=mysqli_query($conn,$query);
 if(!$queryresult){
 	echo "database error";
 }
 else{
 	header("location:bank.php");
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
	           		header("location:bank.php");
	           	}
	           	else{

echo "<html>
<head>
	<title>
		project details
	</title>
	
</head>
<body>
	<div id='project_details,>
	<p class='instructions,>Please fill in all the details in the fields below</p></br>
	<label>step 3 of 5</label>
	<fieldset>
		<legend>Project details</legend>
		<form method='post' action=''enctype='multipart/form-data'>
		Project/Business name: <input type=text' name='project' placeholder='project-name'>
		Existance period: <input type='text' name='period' placeholder='months/years'>
		Project status: <select name='status'><option></option>
		                        <option>NEW</option>
		                        <option>EXPANSION</option>

		                </select><span>
		 <p class='instructions'>give a brief description of the project purpose</p>	</br>
		 <textarea name='purpose' rows='5' cols='60' placeholder='pupose'></textarea><span>
		 <p class='instructions'>please attach a copy of the project proposal below</p></br>
		 <input type='hidden' name='MAX_FILE_SIZE' value='2000000'>
		 <label>file name</label>
         <input name='proposal' type='file' id='userfile'></span></br></br></br>
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
