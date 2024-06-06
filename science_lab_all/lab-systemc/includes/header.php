<?php
  require "database_config.php";
  include "sessions.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lab system</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link btn btn-info text-white" href="logout.php">
          Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <?php
      $file_name = basename($_SERVER['PHP_SELF']);

    ?>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Chemistry Lab</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            <?php
              echo isset($_SESSION['name']) ? $_SESSION['name'] : "";
            ?>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          

          <?php

            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "admin")
            {
             
          ?>
          <!-- Dashboard sidebar menu link -->
          <li class="nav-item">
                <a href="index.php" class="nav-link <?php echo ($file_name=='index.php') ? 'active' : ''; ?>">
                  <i class="fas fa-tachometer-alt nav-icon"></i>
                  <p>Dashboard</p>
                </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link <?php echo ($file_name=='add_equipment.php' || $file_name=='show_equipment.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Equipment
                <i class="fas fa-angle-left right"></i>
              <!--   <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">   
              <li class="nav-item">
                <a href="add_equipment.php" class="nav-link <?php echo ($file_name=='add_equipment.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Equipment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="show_equipment.php" class="nav-link <?php echo ($file_name=='show_equipment.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Show equipment</p>
                </a>
              </li>
            </ul>
          </li>
     
<!-- Users entity  -->
          <li class="nav-item">
            <a href="#" class="nav-link <?php echo ($file_name=='add_users.php' || $file_name=='show_users.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">   
              <li class="nav-item">
                <a href="add_users.php" class="nav-link <?php echo ($file_name=='add_users.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="show_users.php" class="nav-link <?php echo ($file_name=='show_users.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage users</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
                <a href="reservation_details.php" class="nav-link <?php echo ($file_name=='reservation_details.php') ? 'active' : ''; ?>">
                  <i class="fa fa-flask nav-icon"></i>
                  <p>Reservation History</p>
                </a>
              </li>
       <?php

          }
          else{

        ?>
          <li class="nav-item">
                <a href="show_specific_equipment.php" class="nav-link <?php echo ($file_name=='show_specific_equipment.php') ? 'active' : ''; ?>">
                  <i class="fas fa-tachometer-alt nav-icon"></i>
                  <p>Reserved Devices</p>
                </a>
          </li>
           <li class="nav-item">
            <a href="reserve_item.php" class="nav-link  <?php echo ($file_name=='reserve_item.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-flask"></i>
              <p>
                Reserve equipment
                <!-- <i class="fas fa-angle-left right"></i> -->
                <span class="badge badge-info right"></span>
              </p>
            </a>
           </li>
           <li class="nav-item">
                <a href="show_equipment.php" class="nav-link <?php echo ($file_name=='show_equipment.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Available equipments</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="reservation_details.php" class="nav-link <?php echo ($file_name=='reservation_details.php') ? 'active' : ''; ?>">
                  <i class="fa fa-flask nav-icon"></i>
                  <p>Reservation History</p>
                </a>
              </li>
           
           <?php

         }

         ?>
          <!-- <li class="nav-header">EXAMPLES</li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
              <?php
                // echo basename($_SERVER['REQUEST_URI'],'.php');
              ?>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->