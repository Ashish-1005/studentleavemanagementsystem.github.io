<?php

include 'connection.php';

if(!isset($_SESSION['ROLE'])){
   header('location:login.php');
   die();
}

if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($conn,$_GET['id']);
	mysqli_query($conn,"delete from `leave` where id='$id'");
}
if(isset($_GET['type']) && $_GET['type']=='update' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($conn,$_GET['id']);
	$status=mysqli_real_escape_string($conn,$_GET['status']);
	mysqli_query($conn,"update `leave` set leave_status='$status' where id='$id'");
}
if($_SESSION['ROLE']==1){ 
    $sql = "SELECT * FROM `leave` order by id desc ";
}else{
    $eid=$_SESSION['user_id'];
    $sql =  "SELECT * FROM `leave` where student_id = '$eid'order by id desc ";
}

$result = mysqli_query($conn, $sql);

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
                  
                  <?php if($_SESSION['ROLE']==1){?>
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
                  <?php } ?>

                     <?php if(!$_SESSION['ROLE']==1){ ?>

                          <li class="menu-item-has-children dropdown">
                          <a href="add_student.php?id=<?php echo $_SESSION['user_id']?>">Profile</a>
                          </li>

                          <li class="menu-item-has-children dropdown">
                          <a href="leave.php">Leave</a>
                          </li>

                    <?php } ?>

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

                  <?php if(!$_SESSION['ROLE']==1){ ?>
                     <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome Student <?php echo$_SESSION['user_name']?></a>
                     <?php } ?>

                     <?php if($_SESSION['ROLE']==1){?>
                     <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome Admin</a>
                     <?php } ?>

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
                           <h4 class="box-title">Leave </h4>
                           <?php if(!$_SESSION['ROLE']==1){ ?>
						   <h4 class="box-title"><a href="add_leave.php">Add Leave</a> </h4>
                           <?php } ?>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                    <th width="5%">S.No</th>
                                       <th width="5%">ID</th>
									   <th width="15%"> Student Name</th>
                                       <th width="14%">From</th>
									   <th width="14%">To</th>
									   <th width="15%">Description</th>
									   <th width="18%">Leave Status</th>
									   <th width="10%"></th>
                                    </tr>
                                 </thead>
                                  <tbody>
                                    <?php 
									$i=1;
									while($row=mysqli_fetch_assoc($result)){?>
									<tr>
                                       <td><?php echo $i?></td>
									            <td><?php echo $row['id']?></td>
                                                <td><?php echo $row['name']?></td>
                                                <td><?php echo $row['leave_from']?></td>
									            <td><?php echo $row['leave_to']?></td>
									            <td><?php echo $row['leave_description']?></td>
                                                <td>
										           <?php
											       if($row['leave_status']==1){
												        echo "Applied";
											       }if($row['leave_status']==2){
												        echo "Approved";
											       }if($row['leave_status']==3){
												        echo "Rejected";
											           }
                                                   ?>

                                                <?php if($_SESSION['ROLE']==1){ ?>
										        <select class="form-control" onchange="update_leave_status('<?php echo $row['id']?>',this.options[this.selectedIndex].value)">
											    <option value="">Update Status</option>
											    <option value="2">Approved</option>
											    <option value="3">Rejected</option>
										        </select>
										        <?php } ?>

                                                </td>
									            <td>
                                                 <?php
									             if($row['leave_status']==1){ ?>
                                                 <a href="leave.php?id=<?php echo $row['id']?>&type=delete">Delete</a></td>
                                                 <?php } ?>

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
          <script>
		 function update_leave_status(id,select_value){
			window.location.href='leave.php?id='+id+'&type=update&status='+select_value;
		 }
		 </script>

          <div class="clearfix"></div>
         <footer class="site-footer">
            <div class="footer-inner bg-white">
               <div class="row">
                  <div class="col-sm-6">
                     <!-- Copyright &copy; 2018 Ela Admin -->
                  </div>
                  <div class="col-sm-6 text-right">
                     <!-- Designed by <a href="https://colorlib.com/">Colorlib</a> -->
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
         
                                 