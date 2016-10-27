<?php
include"applicants.html";
include "connect.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
if(!empty($_POST['location']) && !empty($_POST['sublocation']) && !empty($_POST['ward']) && !empty($_POST['period']) && !empty($_POST['identity']) && !empty($_POST['purpose']) && !empty($_POST['achievements']) && !empty($_POST['challenges'])){
	
	$groupname=$_SESSION['group_name'];
	$regno=$_SESSION['reg_no'];
	$location=mysql_real_escape_string($_POST['location']);
	$sublocation=mysql_real_escape_string($_POST['sublocation']);
	$ward=mysql_real_escape_string($_POST['ward']);
	$period=mysql_real_escape_string($_POST['period']);
	$identity=mysql_real_escape_string($_POST['identity']);
	$purpose=mysql_real_escape_string($_POST['purpose']);
	$achievements=mysql_real_escape_string($_POST['achievements']);
	$challenges=mysql_real_escape_string($_POST['challenges']);

    $gdtails="insert into applicants_det(group_name,group_reg_no,location,sublocation,ward,period_existed,group_identity,group_purpose,achievement,challenges)
    values('$groupname','$regno','$location','$sublocation','$ward','$period','$identity','$purpose','$achievements','$challenges')";

	$query=mysqli_query($conn,$gdtails);
	if (!$query) {
		echo "database error. could not store";
	}
	else{
		header("location:members.php");
	}
}
 
}
if (isset($_SESSION['group_name']) && isset($_SESSION['reg_no']) && isset($_SESSION['address'])){
$reg_no=$_SESSION['reg_no'];
	$myquery="select period_existed,
	                 location
	           from applicants_det
	           where (group_reg_no='$reg_no')";
	           $loanresult=mysqli_query($conn,$myquery);
	           if (!$loanresult) {
	           	echo "database error";
	           }
	           else{
	           	$row=mysqli_fetch_array($loanresult);
	           	if (!empty($row)) {
	           		header("location: members.php");
	           	}
	           	else{

	echo "<div id='commands'>
			<p class='instruction'>please fill the fields below and proceed to the next step</p>
		</div>
		<label>step 1 of 5</label>
		<fieldset>
			<legend>Group details</legend>
			<form action='' method='post' align='center'>
				
				location: <select name='location' required='required' placeholder='location'>
				<option></option>
				<option>ajhajsdjajnjdc</option>
				<option>b</option>
				<option>c</option>
				<option>d</option>

				</select>";
			    echo ""; 
				echo "</span>
				Sub-location: <select name='sublocation' required='required'>
				<option></option>
				<option>ajhajsdjajnjdc</option>
				<option>b</option>
				<option>c</option>
				<option>d</option>

				</select>";
				 echo "";
				 echo "</span>
				Ward: <select name='ward' required='required'>
				<option></option>
				<option>ajhajsdjajnjdc</option>
				<option>b</option>
				<option>c</option>
				<option>d</option>

				</select>" ;
				echo ""; 
				echo "</span>
				Period the group has existed: <input type='text' name='period' placeholder='months/yrs' required='required'><span>"; echo "";
				echo "</span>
				group identity: <select name='identity' required='required'><option></option>
				                        <option>youths</option>
				                        <option>Women</option>

				</select>";
				echo "";
				echo "</br></br>
				<p class='instructions'>Describe the purpose of the group</p></br><textarea name='purpose' rows='10' cols='60' placeholder='group purpose' required='required'></textarea></br>
				<p class='instructions'>What are the achievements the group has realized</p></br>
				<textarea name='achievements' rows='5' cols='60' placeholder='achievements'required='required'></textarea>";echo "";
				echo "</br>
				<p class='instructions'>what are the challenges encountered</p></br>
				<textarea name='challenges' rows='5' cols='60' placeholder='challenges'required='required'></textarea>";echo "";
				echo "</br></br>
                <input type='submit' value='Next step'>
			</form>";
		}
}
}
else{
	echo "you have to login first in order to proceed";
}


?>
