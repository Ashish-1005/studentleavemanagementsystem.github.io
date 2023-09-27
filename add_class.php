<?php

include "connection.php";

$class='';
$id='';
if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($conn,$_GET['id']);
   $result = mysqli_query($conn,"SELECT * FROM class where id = '$id'");
   $row=mysqli_fetch_assoc($result);
	$class=$row['class'];
}
if(isset($_POST['class'])){
	$class=mysqli_real_escape_string($conn,$_POST['class']);
	if($id>0){
		$sql="update class set class='$class' where id='$id'";
	}else{
		$sql="insert into class(class) values('$class')";
	}
	if (mysqli_query($conn,$sql));
       header('location:index.php');
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
  .container1{
    
      background:#3F6844;
      height:40vh;
      width:70vh;
     margin-top:10vh;
      margin-left:63vh;
      border-radius:2rem;
      position: fixed;
     }
         .heading{

           color: #FAF1CF;
           margin-left:14vh;
           margin-top:5vh;
          }

          .div{
          margin-left:4vh;
          margin-top:8vh;
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
      margin-left:23vh;
      margin-top:1vh;
      width:20vh;
      height:6vh;
      border-radius:3vh;
      cursor: pointer;
      z-index: 2;
      
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

                        <form method = "POST">
							   <div class="div">
								<label for="class" class=" text"><strong>Class Name</strong></label><br>
								<input type="text" value="<?php echo $class?>" name="class" placeholder="Enter your class name" class="input1" required></div><br>

      <button type="submit" class="button" >Submit</button>
    </form>
  </div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
 </body>

</html>

         


