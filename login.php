<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connection.php';
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM  `student` WHERE email = '$email' and password ='$password' ";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num>0){

        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['ROLE'] = $row['role'];
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];

        if($_SESSION['ROLE']==1){
        header('location:index.php');

    }else{
        header('location:leave.php');
    }
}
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <style>

    .body{
      background:#5DAA68;
    }  
    
     .container1{
      background:#3F6844;
      height:80vh;
      width:70vh;
      margin-top:10vh;
      margin-left:65vh;
      border-radius:2rem;
      position: fixed;
     }
         .heading{

           color: #FAF1CF;
           margin-left:27vh;
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
          border-radius:2vh;
          width:40vh;
          height:7vh;
          }
     .input2{
      border:2px solid black;
      border-radius:2vh;
      width:40vh;
      height:7vh;
      margin-left:5.2vh;
     }

     .button{
      background:#FAF1CF;
      color:black;
      border:1px solid black;
      margin-left:25vh;
      margin-top:10vh;
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

<body class="body">


<div class="container1">
    <h1 class="heading">Login</h1>

    <form method="post">
      <div class="div" >
        <label for="email" class="text" >Email Address:</label>
        <input type="text" class="input1" id="email" name="email" placeholder="Enter Your email">
      </div>

      <div class="div" >
        <label for="password" class="text">Password:</label>
        <input type="password" class="input2" id="password" name="password" placeholder="Enter Your Password">
      </div>

      <button type="submit" class="button" >Login</button>
    </form>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
 </body>

</html>