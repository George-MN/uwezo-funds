<html>
<?php
include "connect.php";
$error="";

if ($_SERVER['REQUEST_METHOD']=="POST") {
	
	if(isset($_POST['username']) && isset($_POST['category']) && isset($_POST['password'])){

       if ($_POST['category']=='CHIEF') {
       	$username=$_POST['username'];
       	$password=$_POST['password'];
       	 
       $query1="select  location, username, password
                from chiefs where username='$username'
                and password='$password'";

       }
      else{
           
           $username=$_POST['username'];
       	   $password=$_POST['password'];

       	   $query2="select constituency,
       	                   username,
       	                   category
       	            from allocators
       	            where username='$username'
       	            and password='$password'";

       	    $query2results=mysqli_query($conn,$query2);
       	    if (!$query2results) {
       	    	
       	    	echo "database error";
       	    }
       	    else if (mysqli_num_rows($query2results)==0) {
       	    	$error="invalid credentials";
       	    }
       	    else{

       	    	session_start();
       	    	$row=mysqli_fetch_assoc($query2results);
       	    	$_SESSION['username']=$row['username'];
       	    	$_SESSION['category']=$row['category'];
       	    	$_SESSION['constituency']=$row['constituency'];
       	    	header("location:admin.php");
       	    }

      } 

	}
}



?>

<head>
<title>login</title>
<link rel="stylesheet" type="text/css" href="login.css">

</head>
<body>
	<div class="wrapper" align="center">

<ul class="picts">
	<!--<li id="navig"><img src="uwezo.png" align="center"></li>-->
    <li id="navig"class="govt"><img src="govt.png" align="center"></li>
</ul>
		
	</div>
	<div align="center" class="form">
		<form action="" method="POST" align="center">
<tag>USERNAME</tag>: <input class="inputs" type="text" name="username"  required="required"></br></br>
<tag>CATEGORY</tag>: <select class="inputs" name="category" required="required" placeholder="CATEGORY"></br></br>
            <option></option>
			<option>COMMITTEE</option>
			<option>CHIEF</option>
 </select></br></br>


<tag>PASSWORD</tag>: <input class="inputs" type="password" name="password"  required="required"></br></br>
<span class="error"><?php  echo "$error";?></span></span></br></br>
<input type="submit" value="login">
			
		</form>
	</div>
</body>
</html>