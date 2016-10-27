<?php
include"applicants.html";
include "connect.php";
if($_SERVER['REQUEST_METHOD']=='POST'){

if(!empty($_POST['number'])&& !empty($_POST['fitness']) && ($_FILES['membersfile']['size']>0))
{
	
	if($_FILES['membersfile']['error']==0){
		$registration=$_SESSION['reg_no'];
		$disability=mysql_real_escape_string($_POST['fitness']);
		$number=mysql_real_escape_string($_POST['number']);
		$size=intval($_FILES['membersfile']['size']);
		$type=mysql_real_escape_string($_FILES['membersfile']['type']);
		$content=mysql_real_escape_string(file_get_contents($_FILES['membersfile'])['tmp_name']);
		

      $query="insert into members(reg_no,disability,members_no,size,type,members_det)
              values('$registration','$disability','$number','$size','$type','$content')";
       $results=mysqli_query($conn,$query);


       if(!$results){
       	echo "database error";
       }
       else{
       	header("location:project.php");
       }


	}
}
else{
	
}
}
if (isset($_SESSION['group_name']) && isset($_SESSION['reg_no']) && isset($_SESSION['address'])){
	$reg_no=$_SESSION['reg_no'];
	$myquery="select disability,
	                 members_no
	           from members
	           where (reg_no='$reg_no')";
	           $loanresult=mysqli_query($conn,$myquery);
	           if (!$loanresult) {
	           	echo "database error";
	           }
	           else{
	           	$row=mysqli_fetch_array($loanresult);
	           	if (!empty($row)) {
	           		header("location: project.php");
	           	}
	           	else{
	echo "<title>
			members details
		</title>
		
	</head>
	<body>
		<div>
			<p class='instructions'>Fill all the details in the fields below</p></br>
			<label>step 2 of 5</label>
			<fieldset>
				<legend>
					members details
				</legend>
				<form action='members.php' method='POST' enctype='multipart/form-data'>
				Number of members: <input type='text' name='number'><span id='error' required='required'></span>
				Number with physical disabilities: <input type='text' name='fitness' required='required'><span></br></br>
				<p class='instructions'>Please attach a copy of the members with the following details</br>
                <ul >
                	<li class='det'>Name</li>
                	<li class='det'>Id number</li>
                	<li class='det'>physical disability if any</li>
                	<li class='det'>next of kin</li>
                	<li class='det'>phone number</li>
                	<li class='det'>position in the group</li>

                </ul></p></br>
                
                <input name='membersfile' type='file' id='userfile' ><span></span></br></br>
                <input type='submit' name='next' value='next'>

				
					
				</form>
			</fieldset>

		</div>
	</body>";
}
}
}
else{
	echo "you have to login first in order to proceed";
}

?>
