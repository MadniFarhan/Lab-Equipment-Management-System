<?php include "includes/header.php"; ?>

<?php
  if(!isset($_SESSION['id']))
  {
    header("Location: login.php");
    exit();
  }
  elseif ($_SESSION['user_type'] !== "admin") 
  {
    header("Location: reserve_item.php");
    exit();
  }


?>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
    <?php
      $sql = "SELECT * FROM `equipment`";
      $result = $conn->query($sql);
      $total_devices = $result->num_rows;

    ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $total_devices; ?></h3>
                <p>Total Devices</p>
              </div>
              <div class="icon">
                <i class="fa fa-flask"></i>
              </div>
              <a href="show_equipment.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
    <?php
      $sql = "SELECT * FROM `equipment` WHERE `device_status` = 'reserved'";
      $result = $conn->query($sql);
      $reserved_devices = $result->num_rows;

    ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $reserved_devices; ?></h3>
                <p>Reserved Devices</p>
              </div>
              <div class="icon">
                <!-- <i class="ion ion-stats-bars"></i> -->
                <i class="fa fa-flask"></i>
              </div>
              <a href="show_equipment.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
 <?php
      $sql = "SELECT * FROM `equipment` WHERE `device_status` = 'available'";
      $result = $conn->query($sql);
      $available_devices = $result->num_rows;

    ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?php  echo $available_devices; ?></h3>
                <p>Available Devices</p>
              </div>
              <div class="icon">
                <i class="fa fa-flask"></i>
              </div>
              <a href="show_equipment.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
    <?php
      $sql = "SELECT * FROM `users`";
      $result = $conn->query($sql);
      $total_users = $result->num_rows;

    ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php  echo $total_users; ?></h3>
                <p>Registered Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="show_users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
 
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
         
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php include "includes/footer.php"; ?>