<?php
include"applicants.html";
include "connect.php";
if ($_SERVER['REQUEST_METHOD']=='POST') {

if (!empty($_POST['status']) && !empty($_POST['achievements']) && !empty($_POST['challenges']) && $_FILES['assessments']['size']>0) {
	

	$reg_no=$_SESSION['reg_no'];
	$myquery="select project_no
	          from project
	          where(reg_no='$reg_no')";

	$myqueryresults=mysqli_query($conn,$myquery);
	if(!$myqueryresults){
		echo "database error1";
	}
	else{
         $row=mysqli_fetch_assoc($myqueryresults);
         if (isset($row['project_no'])) {
         	$number=$row['project_no'];
    $status=mysql_real_escape_string($_POST['status']);
	$achievements=mysql_real_escape_string($_POST['achievements']);
	$challenges=mysql_real_escape_string($_POST['challenges']);
	$size=intval($_FILES['assessments']['size']);
	$type=mysql_real_escape_string($_FILES['assessments']['type']);
	$content=mysql_real_escape_string(file_get_contents($_FILES['assessments']['tmp_name']));


         	$query2="insert into assessment(project_no,project_status,achievements,challenges,size,type,fund_usage)
         	         values('$number','$status','$achievements','$challenges','$size','$type','$content')";

         	  $query2results=mysqli_query($conn,$query2);

         	  if (!$query2results) {
         	  	echo "database error22";
         	  }
         	  else{
         	  	header("location: applicants.php");
         	  }
         }
       

	}
}
}

if (isset($_SESSION['group_name']) && isset($_SESSION['reg_no']) && isset($_SESSION['address'])){

  $regno=$_SESSION['reg_no'];
	$myquery3="select project_no
	          from project
	          where(reg_no='$regno')";

$myquery3results=mysqli_query($conn,$myquery3);
	if(!$myquery3results){
		echo "database error3";
	}

	else{
		 $prow=mysqli_fetch_assoc($myquery3results);
         $pnumber=$prow['project_no'];

         $assmquery="select project_status,
                            achievements
                     from assessment
                     where(project_no='$pnumber')";

         $checkresults=mysqli_query($conn,$assmquery);
         if (!$checkresults) {
         	echo "database error";
         }
         else{
         	$myrow=mysqli_fetch_array($checkresults);

         	if(!empty($myrow)){
         		echo "<p class='Welcome'>";
	           	echo "you had already submitted your assessment details.";
	           	echo "</p>";
         	}
         	else{
         		echo "<div id='project_details,>
	<p class='instructions,>Please fill in all the details in the fields below</p></br>
	<label>step 3 of 5</label>
	<fieldset>
		<legend>Project details</legend>
		<form method='post' action=''enctype='multipart/form-data'>
		
		Project/business current status: <select name='status'><option></option>
		                        <option>COMPLETE</option>
		                        <option>UNDERWAY</option>

		                </select><span></br></br>
	    what are the achievement so far </br>:
	    <textarea name='achievements' rows='5' cols='60' placeholder='achievements'required='required'></textarea></br></br>
		what are the challenges encountered so far </br>
		 <textarea name='challenges' rows='5' cols='60' placeholder='challenges'required='required'></textarea></br></br>
		 <input type='hidden' name='MAX_FILE_SIZE' value='2000000'>
		 <label>file name</label>
         <input name='assessments' type='file' id='userfile'></span></br></br></br>
         <input type='submit' value='save'>
		</form>
	</fieldset>

		
	</div>";
         	}
         }
	}
}



?>