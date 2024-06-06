<?php
include "includes/header.php";

if (!isset($_SESSION['id']) || $_SESSION['user_type'] == "admin") {
    header("Location: index.php");
    exit();
}  

if (isset($_POST['reserve_item'])) {
    extract($_POST);

    if (empty($device_id) || empty($from_date_time) || empty($to_date_time)) {
        $_SESSION['ErrorMessage'] = "Fields should not be empty!!";
    } else {
        $from_date_time = date('Y-m-d H:i:s', strtotime($from_date_time));
        $to_date_time = date('Y-m-d H:i:s', strtotime($to_date_time));

        // Check if the reservation is for the current day and time or later
        $currentDateTime = date('Y-m-d H:i:s');
        if ($from_date_time < $currentDateTime) {
            $_SESSION['ErrorMessage'] = "From Date & time should be equal to or later than the current date & time.";
        } elseif ($to_date_time <= $from_date_time || $to_date_time < $currentDateTime) {
            $_SESSION['ErrorMessage'] = "To Date & time should be later than From Date & time and equal to or later than the current date & time.";
        } else {
            // Check if the user has already reserved the selected equipment
            $existingReservationQuery = "SELECT * FROM `reservations` WHERE `user_id` = {$_SESSION['id']} AND `device_id` = {$device_id} AND `is_returned` = 0";
            $existingReservationResult = $conn->query($existingReservationQuery);

            if ($existingReservationResult && $existingReservationResult->num_rows > 0) {
                $_SESSION['ErrorMessage'] = "You have already reserved this equipment. Please return it before making a new reservation.";
            } else {
                // Proceed with the reservation process
                $checkQuantitySql = "SELECT remaining_quantity FROM `equipment` WHERE `id` = {$device_id}";
                $checkResult = $conn->query($checkQuantitySql);

                if ($checkResult && $checkResult->num_rows > 0) {
                    $equipment = $checkResult->fetch_assoc();
                    $remaining_quantity = $equipment['remaining_quantity'];

                    if ($remaining_quantity > 0) {
                        // Insert reservation record
                        $sql = "INSERT INTO `reservations` SET `user_name` = '{$uname}', 
                                `user_id` = {$_SESSION['id']}, 
                                `device_id` = '{$device_id}',`from_date_time` = '{$from_date_time}',
                                `to_date_time` = '{$to_date_time}';";

                        // Update equipment status and remaining quantity
                        $sql .= "UPDATE `equipment` SET `device_status` = 'reserved', 
                                `user_id` = {$_SESSION['id']}, 
                                `remaining_quantity` = `remaining_quantity` - 1
                                WHERE `id` = {$device_id}";

                        if ($conn->multi_query($sql)) {
                            $_SESSION['SuccessMessage'] = "Reserved Successfully!!";
                        } else {
                            $_SESSION['ErrorMessage'] = "Something went wrong!!";
                        }
                    } else {
                        $_SESSION['ErrorMessage'] = "No more available equipment!";
                    }
                } else {
                    $_SESSION['ErrorMessage'] = "Failed to retrieve equipment information!";
                }
            }
        }
    }
}
?>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="offset-3 col-lg-6 offset-3">
             <!-- Input addon -->
             <?php
              echo errorFunction();
              echo successFunction();

             ?>
            <form action="" method="POST">
                <div class="card card-info">
                    <div class="card-header" style="background-color: #4f5962;">
                      <h3 class="card-title">Reserve Item Form</h3>
                      <a href="show_specific_equipment.php" class="float-right btn btn-info">Back </a>
                    </div>
                    <div class="card-body">
                      <label for="exampleInputEmail1">Name:</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">@</span>
                        </div>
                        <input type="text" name="uname" class="form-control"  placeholder="Enter your name" value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ""; ?>">
                      </div>
                    
                      <div class="form-group">
                            <label>Choose device</label>
                    
                            <select class="form-control" name="device_id">
                              <option>Select device</option>
                              <?php
                                $sql = "SELECT * FROM `equipment`";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0)
                                {
                                  $devices = $result->fetch_all(MYSQLI_ASSOC);

                                  foreach ($devices as $device) 
                                  {
                                    extract($device);
                                   
                              ?>
                              <option value="<?php  echo $id; ?>"><?php  echo $device_name; ?></option>
                              <?php
                                  }
                                }

                              ?>
                            </select>
                      </div>
                      <!-- Date and time range -->
                        <div class="form-group">
                          <label>From Date & time:</label>
                            <div class="input-group date" id="from_reservationdatetime" data-target-input="nearest">
                                <input type="text" name="from_date_time" class="form-control datetimepicker-input" data-target="#from_reservationdatetime"/>
                                <div class="input-group-append" data-target="#from_reservationdatetime" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                          <label>To Date & time:</label>
                            <div class="input-group date" id="to_reservationdatetime" data-target-input="nearest">
                                <input type="text" name="to_date_time" class="form-control datetimepicker-input" data-target="#to_reservationdatetime"/>
                                <div class="input-group-append" data-target="#to_reservationdatetime" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                      <input type="submit" value="Reserve" class="btn btn-info" name="reserve_item">
                    </div>
                </div>
            </form>
          </div>
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