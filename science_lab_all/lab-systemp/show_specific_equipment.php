<?php include "includes/header.php"; ?>
<?php  

  if(!isset($_SESSION['id']) || $_SESSION['user_type'] == "admin")
  {
    header("Location: index.php");
    exit();
  }

  
 ?>
<?php
// Check if reservation time has passed

$sql = "SELECT * FROM reservations WHERE to_date_time < NOW() AND is_returned = 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Reservation time has passed, so display alert message
    
    // $_SESSION['ErrorMessage'] = "Your device reservation time has ended. Please return it as soon as possible.";
    
}
?>




    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
            <div class="offset-1 col-lg-10">
            <?php
              echo errorFunction();
              echo successFunction();

             ?>
              <div class="card">
                <div class="card-header">
                  <h2 class="float-left">Devices</h2>
                  <a href="add_equipment.php" class="btn btn-info float-right">Reserve device</a>
                </div>
                  <table class="table table-bordered  table-striped table-hover">
                    <thead class="thead-dark">
                      <tr class="text-center">
                        <th>Sr. No.</th>
                        <th>Device Name</th>
                        <th>Device Image</th>
                        <th>Status</th>
                        <th>Reserved Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
              $sql = "SELECT eq.`id`,  
                eq.`device_name`,
                 eq.`user_id`, 
                eq.`device_image`,
                eq.`device_status`,
                reservations.`id` as `res_id`,
                reservations.`device_id`,
                reservations.`from_date_time`,
                reservations.`to_date_time`
        FROM `equipment` as eq
        LEFT JOIN `reservations` 
        ON eq.id = reservations.device_id
        WHERE ( reservations.`user_id` = {$_SESSION['id']})
        AND eq.device_status = 'reserved'
        AND reservations.is_cancelled = 0
        AND reservations.is_returned = 0
        GROUP BY eq.id";



                        $result = $conn->query($sql);

                        if($result->num_rows > 0)
                        {
                          $records = $result->fetch_all(MYSQLI_ASSOC);
                          $sr = 0;
                          foreach ($records as $record) 
                          {
                            extract($record);
                            $sr++;    

                      ?>
                            <tr class="text-center">
                              <td><?php echo $sr; ?></td>
                              <td><?php echo $device_name; ?></td>
                              <td><img width="80px" src="uploads/<?php echo $device_image; ?>"></td>
                              <td><?php echo $device_status; ?></td>
                              <td><?php echo $from_date_time; ?></td>
                              <td>
                                <a href="device_return.php?device_id=<?php echo $id; ?>&res_id=<?php echo $res_id; ?>" class="btn btn-info">return</a>
                                <a href="cancel_reservation.php?device_id=<?php echo $id; ?>&res_id=<?php echo $res_id; ?>" class="btn btn-warning">cancel</a>
                              </td>
                            </tr>
                      <?php

                          }
                        }
                      ?>
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php include "includes/footer.php"; ?>