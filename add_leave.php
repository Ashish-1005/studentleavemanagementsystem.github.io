<?php
  
  include 'connection.php';
 
if(isset($_POST['submit'])){
   $name=mysqli_real_escape_string($conn,$_POST['name']);
	$leave_id=mysqli_real_escape_string($conn,$_POST['leave_id']);
	$leave_from=mysqli_real_escape_string($conn,$_POST['leave_from']);
	$leave_to=mysqli_real_escape_string($conn,$_POST['leave_to']);
	$student_id=$_SESSION['user_id'];
	$leave_description=mysqli_real_escape_string($conn,$_POST['leave_description']);

	$sql="insert into `leave`(name,leave_id,leave_from,leave_to,student_id,leave_description,leave_status) values('$name','$leave_id','$leave_from','$leave_to','$student_id','$leave_description',1)";

	mysqli_query($conn,$sql);
	header('location:leave.php');
	die();
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form</title>
  <style>
   .row{
      justify-content:center;
   }
   .card-header{
      text-align:center;
   }
   
   .container1{
      background:#3F6844;
      height:100vh;
      width:70vh;
     
      margin-left:63vh;
      border-radius:2rem;
      position: fixed;
     }
         .heading{
           color: #FAF1CF;
           margin-left:14vh;
           margin-top:5vh;
          }

          .form-group{
          margin-left:4vh;
          margin-top:3vh;
          }
          
          .form-control{
          border:2px solid black;
          border-radius:1vh;
          width:60vh;
          height:5.5vh;
          }
          
          .button{
      background:#FAF1CF;
      color:black;
      border:1px solid black;
      margin-left:25vh;
      margin-top:4vh;
      width:20vh;
      height:6vh;
      border-radius:3vh;
      cursor: pointer;
      
     }

     .button:hover{
      background:#5DAA68;
      color:black;
     }
      
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body class="bg-success">

                        <div class="container1">
                        <h1 class="heading">Leave Type Form</h1>
                        <form method="post">
                           
                           <div class="form-group">
									<label class=" form-control-label">Name</label>
									<input type="text" name="name" placeholder="Enter student name" class="form-control" required>
								</div>
						   
								<div class="form-group">
									<label class=" form-control-label">Leave Type</label>
									<select name="leave_id" required class="form-control">
										<option value="">Select Leave</option>
                              <?php
						              $result=mysqli_query($conn,"select * from leave_type order by leave_type desc");
					                 while($row=mysqli_fetch_assoc($result)){
			                       echo "<option value=".$row['id'].">".$row['leave_type']."</option>";
		                          }
				                    ?>
										
									</select>
								</div>

							   <div class="form-group">
									<label class=" form-control-label">From Date</label>
									<input type="date" name="leave_from"  class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">To Date</label>
									<input type="date" name="leave_to" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Leave Description</label>
									<input type="text" name="leave_description" class="form-control" >
								</div>
								
                        <button type="submit" name="submit" class="button" >Submit</button>
                        
          </form>
         </div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
 </body>
         
</html>
            