<?php include "includes/header.php"; ?>
<?php  
  if($_SESSION['user_type'] !== "admin" && $_SESSION['user_type'] !== "student")
  {
    header("Location: index.php");
    exit();
  }
 ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
            <div class="offset-2 col-lg-8 offset-2">
              <div class="card" style="width:590px">
                <div class="card-header">
                  <h2 class="float-left">Device Details</h2>
                </div>
                <?php
                if (isset($_GET['device_id'])) 
                {
                  $sql = "SELECT equipment.`device_name`,equipment.`device_image`,
                         equipment.`device_status`, reservations.`user_name`,
                         reservations.`from_date_time`,
                         reservations.`to_date_time`
                         FROM `equipment`
                         LEFT JOIN `reservations` ON
                         equipment.id = reservations.device_id
                         WHERE equipment.`id` = {$_GET['device_id']}";

                        $result = $conn->query($sql);
                        if($result->num_rows > 0)
                        {
                          $record = $result->fetch_assoc();
                          extract($record);
                        
                        }
                }
                 

                ?>
                <div class="card-body">
                  <div class="float-left"><img src="uploads/<?php echo $device_image; ?>" width="200px"></div>
                  <div class="float-left ml-5">
                    <p><b>Name:</b> <?php echo $device_name; ?></p>
                    <?php
                      if($device_status == "reserved")
                      {
                        echo "<p><b>Status: </b>{$device_status} By {$user_name}</p>";
                        echo "<p><b>From Date: </b>{$from_date_time} </p>";
                        echo "<p><b>To Date: </b>{$to_date_time} </p>";
                      }
                      else
                      {
                        echo "<p><b>Status: </b>{$device_status}</p>";

                      }
                    ?>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php include "includes/footer.php"; ?>