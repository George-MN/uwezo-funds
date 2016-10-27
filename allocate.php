<?php


include "admin.html";
include "connect.php";
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['category'])) {
	

$comf=1;
$queries="select applicants_det.group_name,
                       applicants_det.group_reg_no,
                       applicants_det.status,
                       loan.loan_no,
                       loan.amount_applied,
                       loan.repayment_period
                from loan
                LEFT join applicants_det
                on
                    applicants_det.group_reg_no=loan.reg_no
                where 
                (applicants_det.status='$comf')";

                $queriesresult=mysqli_query($conn,$queries);

                if (!$queriesresult) {
                	echo "database error";
                }
                else if(mysqli_num_rows($queriesresult)==0){

                	echo "no approved groups";

                }
                else{
                	$row=$row=mysqli_fetch_assoc($queriesresult);
                    
                    echo "<span align='center'>GROUP DETAILS</span>";
                    echo '<table class="table1" border="1">
         
                      <tr>
                        <th>GROUP NAME</th>
                        <th>REGISTRATION NO.</th>
                        <th>AMOUNT APPLIED</th>
                        <th>PROPOSED REPAYMENT TIME</th>
                        
                        ';

                      if (isset($_SESSION['category']) && $_SESSION['category']==1) {
                        	echo "<th>ALLOCATE FUNDS</th>";
                        	      
                        }  
                        
                        
                      echo "</tr>";

                       while ($row=mysqli_fetch_assoc($queriesresult)) {
                       	$myloan=$row['loan_no'];
                        $myquery="select status,
	  		                             amount_allocated,
	  		                             reason,
	  		                             repayment_time
	  		                      from allocations
	  		                      where(loan_no='$myloan')";

	  		               $res=mysql_query($conn,$myquery);
	  		               if (!$res) {
	  		               	echo "database error 2";
	  		               } 
	  		               elseif (mysqli_num_rows($res)>0) {
	  		               //echo "No currently approved groups";
	  		               }
	  		               else{
                          $row2=mysqli_fetch_assoc($res);
	  		               
                      	echo "<tr>";
                      	echo "<td>";
                      	echo $row['group_name'];
                      	echo "</td>";
                      	echo "<td>";
                      	echo $row['reg_no'];
                      	$reg_no=$row['reg_no'];
                      	echo "</td>";
                      	echo "<td>";
                      	echo $row['amount_applied'];
                      	echo "</td>";
                      	echo "<td>";
                      	echo $row['repayment_period'];
                      	echo "</td>";
                       if (isset($_SESSION['category']) && $_SESSION['category']==1) {
                      	echo "<td>";
                      	  echo '<h3><a href="amount.php?id=' . $row2['loan_no'] . '">' . $row['group_name'] . 'alloccate</a><h3>';
                      
                      	echo "</td>";
                      	
                      }
                      }
                      	

                      }


                }
            }
            else{
            	echo "<span class='error'> you need to login first</span>";
            }



?>