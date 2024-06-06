<?php include "includes/header.php"; ?>
<?php  
  if($_SESSION['user_type'] !== "admin")
  {
    header("Location: index.php");
    exit();
  }
 ?>
<?php

  if(isset($_POST['add_item']))
  {
    
    $device_name = htmlspecialchars($_POST['device_name']);
    $quantity = ($_POST['quantity']);
    $remaining_quantity = ($_POST['remaining_quantity']);
    $device_image = $_FILES['device_image']['name'];
    $target = "uploads/".basename($_FILES['device_image']['name']);

    if(empty($device_name) || empty($device_image) || empty($quantity))
    {
      $_SESSION['ErrorMessage'] = "Fields should not be empty!!";
    }
    else
    {
       $sql = "INSERT INTO `equipment` SET `device_name` = '{$device_name}', 
        `device_image` = '{$device_image}', `device_status` = 'available',`quantity` = {$quantity},`remaining_quantity` = {$quantity}";
        move_uploaded_file($_FILES['device_image']['tmp_name'],$target);
       if($conn->query($sql))
       {
         $_SESSION['SuccessMessage'] = "Successfully inserted!!";
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
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="card card-info">
                    <div class="card-header" style="background-color: #4f5962;">
                      <h3 class="card-title">Add Equipmet Form</h3>
                      <a href="show_equipment.php" class="float-right btn btn-info">Back to listing</a>
                    </div>
                    <div class="card-body">
                      <label for="exampleInputEmail1">Device Name:</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-microscope"></i></span>
                        </div>
                        <input type="text" name="device_name" class="form-control" placeholder="Enter device name..">
                      </div>
                        <div class="form-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="device_image">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-sort-numeric-up"></i></span>
                        </div>
                        <input type="number" name="quantity" class="form-control" placeholder="Enter quantity.." min="1">
                        <input type="number" name="remaining_quantity" class="form-control" placeholder="Enter remaining_quantity.." min="1">
                        </div>
                    </div>
                    <div class="card-footer">
                      <input type="submit" value="Add" class="btn btn-info" name="add_item">
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