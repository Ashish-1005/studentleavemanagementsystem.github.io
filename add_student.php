<?php

include "connection.php";

$name='';
$email='';
$mobile='';
$class_id='';
$address='';
$birthday='';
$id='';

if(isset($_GET['id'])){
    
	$id=mysqli_real_escape_string($conn,$_GET['id']);

	$result=mysqli_query($conn,"select * from student where id='$id'");
	$row=mysqli_fetch_assoc($result);
	$name=$row['name'];
	$email=$row['email'];
	$mobile=$row['mobile'];
	$class_id=$row['class_id'];
	$address=$row['address'];
	$birthday=$row['birthday'];
}
if(isset($_POST['submit'])){

	$name=mysqli_real_escape_string($conn,$_POST['name']);
	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$mobile=mysqli_real_escape_string($conn,$_POST['mobile']);
	$password=mysqli_real_escape_string($conn,$_POST['password']);
	$class_id=mysqli_real_escape_string($conn,$_POST['class_id']);
	$address=mysqli_real_escape_string($conn,$_POST['address']);
	$birthday=mysqli_real_escape_string($conn,$_POST['birthday']);

	if($id>0){
		$sql="update student set name='$name',email='$email',mobile='$mobile',password='$password',class_id='$class_id',address='$address',birthday='$birthday' where id='$id'";
	}else{
		$sql="insert into student(name,email,mobile,password,class_id,address,birthday) values('$name','$email','$mobile','$password','$class_id','$address','$birthday')";
	}
	
	mysqli_query($conn,$sql);
	header('location:student.php');
	die();
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Entry Form</title>
  <style>
   
   body{

      background:#000000;
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
           margin-left:10vh;
           margin-top:5vh;
          }

          .div{
          margin-left:4vh;
          margin-top:2vh;
          }

          .text{
            font-size:20px;
            color: #FAF1CF;
          }
        
          .input1{
          border:2px solid black;
          border-radius:1vh;
          width:60vh;
          height:5.5vh;
          }
     .input2{
      border:2px solid black;
      border-radius:1vh;
      width:60vh;
      height:5.5vh;
      margin-left:0.2vh;
     }

     .button{
      background:#FAF1CF;
      color:black;
      border:1px solid black;
      margin-left:21vh;
      margin-top:2vh;
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
 <body class = bg-success>

 <div class="container1">
    <h1 class="heading">Student Entry Form</h1>

    <form method="post">
       <div class="div">
        <label for="name" class="text" >Name:</label>
		<input type="text" value="<?php echo $name?>" name="name" placeholder="Enter student name" class="input1" required>
       </div>

	   <div class="div">
				<label for="email" class="text">Email</label>
						<input type="email" value="<?php echo $email?>" id="email" name="email" placeholder="Enter student email" class="input1" required>
								</div>
								<div class="div">
									<label for="mobile"  class="text">Mobile</label>
									<input type="text" value="<?php echo $mobile?>" name="mobile" placeholder="Enter student mobile" class="input1" required>
								</div>
								<div class="div">
									<label for="password" class="text">Password</label>
									<input type="password"  name="password" placeholder="Enter student password" class="input1" required>
								</div>
								<div class="div">
									<label for="class_id" class="text">Class</label>
									<select name="class_id" required class="input1">
										<option value="">Select Class</option>
										<?php
										$result=mysqli_query($conn,"select * from class order by class desc");
										while($row=mysqli_fetch_assoc($result)){
											if($class_id==$row['id']){
												echo "<option selected='selected' value=".$row['id'].">".$row['class']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['class']."</option>";
											}
										}
										?>
									</select>
								</div>
								<div class="div">
									<label for="address" class="text">Address</label>
									<input type="text" value="<?php echo $address?>" name="address" placeholder="Enter student address" class="input1" required>
								</div>
								<div class="div">
									<label for="birthday" class="text">Birthday</label>
									<input type="date" value="<?php echo $birthday?>" name="birthday" placeholder="Enter student birthday" class="input1" required><br>
								</div>
		
							   

      <button type="submit" name="submit" class="button" >Submit</button>
    </form>
  </div>
  
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
 </body>

</html>

                  
