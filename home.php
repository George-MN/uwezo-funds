
<html>
<head>
<title>uwezo fund application and allocation </title>
<link rel="stylesheet" type="text/css" href="uwezo.css">
<script type="text/javascript" src="jquery-2.1.1.js"></script>
<script src="jquery.js"></script>
<script src="jquery.cycle2"></script>
<script src="jquery.min.js"></script>
<script src="jquery.cycle2.js"></script>
<script src="jquery.cycle2.tile.js"></script>
<script type="uwezo.js"></script>

</head>
<body>
<div id="myhead">
<div id="fixed">
<script>
function sticky_relocate() {
  var window_top = $(window).scrollTop();
  var div_top = $('#myhead').offset().top;
  if (window_top > div_top) {
    $('#fixed').addClass('stick');
  } else {
    $('#fixed').removeClass('stick');
  }
}

$(function() {
  $(window).scroll(sticky_relocate);
  sticky_relocate();
});
</script>
<div class="logos">
  <ul class="picts">
	<li id="navig"><img src="uwezo.png" align="center" height="100px" width="100"></li>
	<li id="navig"></li>
	<li id="navig"></li>
	<li id="navig"></li>
	<li id="navig"></li>
	<li id="navig"class="govt"><img src="govt.png" align="center" height="100px" width="100"></li>
</ul>
</div>
	<div class="head">
	<ul>
		<li id="navig"class="home"><a  href="home.php">HOME</a></li>
		<li id="navig"class="apply"><a href="#apply">APPLY</a></li>
		<li id="navig"class="about"><a href="#about">ABOUT</a></li>
		<li id="navig"class="contact"><a href="#contact">CONTACT US</a></li>
		<li id="navig"class="sign"><a href="#sign">SIGN-UP</a></li>
		<li id="navig"class="login"><a href="#login">LOGIN</a></li>
     </ul>
	</div>
	</div>
	</div>
	
	<!------------------------------------SLIDES SECTION---------------->


	<div id="home"class="cycle-slideshow" data-cycle-fx="tileSlide">
	<img src="images/myuwezo.jpg" width="100%" height="80%" align="center">
	<img src="images/uwezo projects.jpg"width="100%" height="80%">
	<img src="images/uwezo registering.jpg"width="100%" height="80%">
	<img src="images/uwezo.jpg"width="100%" height="90%">

		
	</div>
	<!--------------------------------HOW TO APPLY------------------------>
	<div id="apply">
		how to apply
	</div>
	
	<!---------------------------------SIGN UP SECTION-------------------->
	<?php
	include "connect.php";
$nameerr=$emailerr=$passwordverr=$addresserr=$passmismatch=$regnoerr=$errorcorrection=$passmatcherr=$passworderr="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(empty($_POST['groupname'])){
		$nameerr="*";
	}
	if(empty($_POST["regno"])){
		$regnoerr="*";
	}
	if (empty($_POST["address"])) {
		$addresserr="*";
	}
	if (empty($_POST["email"])) {
		$emailerr="*";
	}
	if(empty($_POST["password"])){
		$passworderr="*";
	}
	if(empty($_POST["passmatch"])){
		$passmatcherr="*";
	}
	if (empty($_POST['groupname']) || empty($_POST["regno"]) || empty($_POST["address"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["passmatch"])) {
		$errorcorrection="the fields marked with * are required</br></br>";

	}
	else if((!empty($_POST['groupname']) && !empty($_POST["regno"]) && !empty($_POST["address"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["passmatch"]))){
		if($_POST["password"] != $_POST["passmatch"])
		{
			$passmismatch="pasword mismatch";
		}
		else{
			        $groupname=mysql_real_escape_string($_POST['groupname']);
            		$regno=mysql_real_escape_string($_POST['regno']);
            		$address=mysql_real_escape_string($_POST['address']);
            		$email=mysql_real_escape_string($_POST['email']);
            		$password=mysql_real_escape_string($_POST['password']);

            $nodup="select group_name from applicants where(group_name='$groupname')";
            $check=mysqli_query($conn,$nodup);
            if(!$check){
            	echo "database error";
            }
              $result=mysqli_fetch_array($check);
             
             if(empty($result)){
            	
            	    
                    $sql="insert into applicants(group_name,reg_no,address,group_email,password)
  	                      values('$groupname','$regno','$address','$email','$password')";
  	                $insert=mysqli_query($conn,$sql);
  	                if(!$insert){
  	                	echo "DATABASE ERROR- could not insert";
  	                }
                    else{
                    	//session_start();
                    	$_SESSION['groupname']=$groupname;
                    	$_SESSION['group_reg']=$regno;
                    	$_SESSION['address']=$address;
                    	
                    	if(!empty($_SESSION['groupname']) && !empty($_SESSION['group_reg']) && !empty($_SESSION['address'])){
                        
                        header("location:bank.php");
                    }
                 
            	
            }
        }
            else{
            	$errorcorrection="the group name already exists</br>";	
                }

            	
           
		}
	}
}


	?>
	<div id="sign">
		<form class="mysign" method="post" action="">
	<input class="gname" type="text" name="groupname" placeholder="GROUP NAME"><span class="error"><?php echo "$nameerr"; ?></span>
	 <input class="regno"type="text" name="regno" placeholder="REGISTRATION NUMBER"><span class="error"> <?php echo "$regnoerr"; ?></span></br></br></br>
	 <input class="address"type="text" name="address" placeholder="ADDRESS"><span class="error"> <?php echo "$addresserr"; ?></span>
	 <input class="email"type="email" name="email" placeholder="EMAIL"><span class="error"> <?php echo "$emailerr"; ?></span></br></br>	
     <input class="password"type="password" name="password" placeholder="PASSWORD"><span class="error"> <?php echo "$passworderr"; ?></span>
     <input class="passmatch"type="password" name="passmatch" placeholder=" CONFIRM PASSWORD"><span class="error"> <?php echo "$passmatcherr </br>$passmismatch"; ?></span></br></br></br>
     <span class="error"> <?php echo "</br>$errorcorrection"; ?></span>
     <input class="submit" type="submit" value="submit">
	</form>
	</div>
	<!--------------------------------LOGIN SECTION------------------------>
	<?php
	   $gnameerror=$correct=$passworderror="";
         if($_SERVER["REQUEST_METHOD"]=="POST"){
         	
         	if(empty($_POST['groupname'])){
               $gnameerror="*";
         	}
         	if(empty($_POST['password'])){
               $passworderror="*";
         	}
         	if(!empty($_POST['groupname']) && !empty($_POST['password'])) {
         		$gname=mysql_real_escape_string($_POST['groupname']);
         		$password=mysql_real_escape_string($_POST['password']);
         		$query="SELECT group_name,
         		               address,
         		               reg_no
         		        FROM applicants
         		        WHERE group_name='$gname'
         		        AND password='$password'";
         		        $myresult=mysqli_query($conn,$query);
         		        if (!$myresult) {
         		        	echo "an error occurred while accessing database";
         		        }
         		        else{
        
         		        	if(mysqli_num_rows($myresult)==0){
         		        		$correct="wrong groupname or password";
         		        		echo "$gname $password";
         		        	}
         		        	else{
         		        		SESSION_START();

         		        		while($row=mysqli_fetch_assoc($myresult)){
                                 // echo $row['group_name'];
         		        		$_SESSION['group_name']= $row['group_name'];
         		        	    $_SESSION['address']= $row['address'];
         		        	    $_SESSION['reg_no']= $row['reg_no'];
         		        	   echo $_SESSION['reg_no'];
         		        	   echo "</br>";
         		        	   echo $_SESSION['address'];
         		        	   echo "</br>";
         		        	   echo $_SESSION['group_name'];
         		        	   //header("location:applicants.php");
         		        	   if(!empty($_SESSION['group_name']) && !empty($_SESSION['reg_no']) && !empty($_SESSION['address'])){
                               header("location:applicants.php");

                    }
                }
         		        	}
         		        }
         	}

         }


	?>
	<div id="login">
		<form class="mylogin" method="post" action="">
	<input class="lgname" type="text" name="groupname" placeholder="GROUP NAME"><span class="error"><?php echo "$gnameerror"; ?></span>
	 <input class="lpassword"type="password" name="password" placeholder="PASSWORD"><span class="error"> <?php echo "$passworderror"; ?></span></br>
	 <span class="error"><?php echo "$correct</br></br></br>";?></span>
	 <input class="submit" type="submit" value="submit">
	</form>
	</div>
	<!------------------------------------CONTACT US SECTION------------>


	<div id="about">
	<h1 class="about">ABOUT US</h1>
	
		<p>contacts</p>
	</div>


	<!-------------------------------ABOUT US SECTION-------------------->
	<div id="contact">
	<h1 class="contact">CONTACT US</h1>
	<img class="contactimage" src="images/contacts-icon.png" align="center" height="70px" width="70px">
	</div>
	
</body>
</html>