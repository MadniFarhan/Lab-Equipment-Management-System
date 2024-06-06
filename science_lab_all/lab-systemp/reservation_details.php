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
            <div class="offset-1 col-lg-10">
              <div class="card">
                <div class="card-header">
                  <h2 class="float-left">Reservation Details</h2>
                </div>
                  <table class="table table-bordered  table-striped table-hover">
                    <thead class="thead-dark">
                      <tr class="text-center">
                        <th>Sr. No.</th>
                        <th>Device Name</th>
                        <th>Device Image</th>
                        <th>Reserved By</th>
                        <th>From Date</th>
                        <th>To Date</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                        $sql = "SELECT res.id,res.user_name,res.device_id,
                              res.from_date_time,res.to_date_time,
                              eq.device_name,eq.device_image
                              FROM `reservations` as res
                              LEFT JOIN equipment as eq ON
                              res.device_id = eq.id
                              ORDER BY res.id DESC
                              ";
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
                              <td><?php echo $user_name; ?></td>
                              <td><?php echo $from_date_time; ?></td>
                              <td><?php echo $to_date_time; ?></td>
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