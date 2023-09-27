<?php

include 'connection.php';

if(!isset($_SESSION['ROLE'])){
   header('location:login.php');
   die();
}

if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($conn,$_GET['id']);
	mysqli_query($conn,"delete from class where id='$id'");
}

$result = mysqli_query($conn,"SELECT * FROM class order by id desc");

?>



<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Dashboard Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>
   <body>
      <aside id="left-panel" class="left-panel">
         <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
               <ul class="nav navbar-nav">
                  <li class="menu-title">Menu</li>

				      <li class="menu-item-has-children dropdown">
                     <a href="index.php" > Class Section</a>
                  </li>

                  <li class="menu-item-has-children dropdown">
                     <a href="leave_type.php" > Leave Type</a>
                  </li>

				      <li class="menu-item-has-children dropdown">
                     <a href="student.php" > Student Section</a>
                  </li>

                  <li class="menu-item-has-children dropdown">
                  <a href="leave.php">Leave</a>
                  </li>

<!--                   
                     <li class="menu-item-has-children dropdown">
                     <a href="add_student.php?id=<?php echo $_SESSION['user_id']?>" >Profile</a>
                     </li>

                     
                     <li class="menu-item-has-children dropdown">
                     <a href="leave.php">Leave</a>
                     </li> -->

               </ul>
            </div>
         </nav>
      </aside>
      <div id="right-panel" class="right-panel">
         <header id="header" class="header">
            <div class="top-left">
               <div class="navbar-header">
                  <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="Logo"></a>
                  <a class="navbar-brand hidden" href="index.php"><img src="images/logo2.png" alt="Logo"></a>
                  <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
               </div>
            </div>
            <div class="top-right">
               <div class="header-menu">
                  <div class="user-area dropdown float-right">
                     <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome Admin</a>
                     <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="login.php"><i class="fa fa-power-off"></i>Logout</a>
                     </div>
                  </div>
               </div>
            </div>
         </header>

         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Class Section </h4>
						   <h4 class="box-title"><a href="add_class.php">Add Class</a> </h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th width="5%">S.No</th>
                                       <th width="5%">ID</th>
                                       <th width="70%">Class Name</th>
                                       <th width="20%"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
									$i=1;
									while($row=mysqli_fetch_assoc($result)){?>
									<tr>
                                       <td><?php echo $i?></td>
									            <td><?php echo $row['id']?></td>
                                       <td><?php echo $row['class']?></td>
									            <td><a href="add_class.php?id=<?php echo $row['id']?>">Edit</a> <a href="index.php?id=<?php echo $row['id']?>&type=delete">Delete</a></td>
                                    </tr>
									<?php 
									$i++;
									} ?>
                                 </tbody>
                                 </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>

          <div class="clearfix"></div>
         <footer class="site-footer">
            <div class="footer-inner bg-white">
               <div class="row">
                  <div class="col-sm-6">
                     Copyright &copy; 2018 Ela Admin
                  </div>
                  <div class="col-sm-6 text-right">
                     Designed by <a href="https://colorlib.com/">Colorlib</a>
                  </div>
               </div>
            </div>
         </footer>
      </div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>
         
                                 