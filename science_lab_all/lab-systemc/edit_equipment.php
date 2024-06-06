<?php
include "includes/header.php";

if ($_SESSION['user_type'] !== "admin") {
    header("Location: index.php");
    exit();
}

if (isset($_POST['edit_item'])) {
    $update_id = $_GET['device_id']; // Assuming you are passing the user_id through the URL
    $update_name = mysqli_real_escape_string($conn, $_POST['device_name']);
    $update_image =$_FILES['device_image']['name'];
    $update_image_tmp_name =$_FILES['device_image']['tmp_name'];
    $update_image_folder = 'uploads/'.$update_image;
    $update_quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $update_remquantity = mysqli_real_escape_string($conn, $_POST['remaining_quantity']);


    $sql = "UPDATE `equipment` SET device_name = '$update_name', device_image = '$update_image', quantity = '$update_quantity', remaining_quantity= '$update_remquantity' WHERE id = '$update_id'";

    if ($conn->query($sql)) {
        move_uploaded_file($update_image_tmp_name, $update_image_folder);
        $_SESSION['SuccessMessage'] = "Updated Successfully!!";
    } else {
        $_SESSION['ErrorMessage'] = "Error: " . $conn->error;
    }
}

?>


<?php
   
   
    if(isset($_GET['device_id'])){
       $edit_id = $_GET['device_id'];
       $edit_query = mysqli_query($conn, "SELECT * FROM `equipment` WHERE id = $edit_id");
       if(mysqli_num_rows($edit_query) > 0){
          while($fetch_edit = mysqli_fetch_assoc($edit_query)){
 
 
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
                      <h3 class="card-title">Edit Equipmet Device Form</h3>
                      <a href="show_equipment.php" class="float-right btn btn-info">Back to listing</a>
                    </div>
                    <div class="card-body">
                      <label for="exampleInputEmail1">Device Name:</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-microscope"></i></span>
                        </div>
                        <input type="text" name="device_name" class="form-control" value="<?php echo $fetch_edit['device_name']; ?>" placeholder="Enter device name..">
                      </div>
                      <label for="exampleInputEmail1">Current Image:</label>
                        <div class="form-group">
                        <small class="text-muted"><img src="<?php echo 'uploads/' . $fetch_edit['device_image']; ?>" alt="Current Image" style="max-width: 120px; "></small>
                          <div class="custom-file">
                            
                            <input type="file" class="custom-file-input" id="customFile" name="device_image" value="<?php echo $fetch_edit['device_image']; ?>">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-sort-numeric-up"></i></span>
                        </div>
                        
                        <input type="number" name="quantity" class="form-control" value="<?php echo $fetch_edit['quantity']; ?>" placeholder="Enter quantity.." min="1">
                        <input type="number" name="remaining_quantity" class="form-control" value="<?php echo $fetch_edit['remaining_quantity']; ?>"placeholder="Enter remaining_quantity.." min="1">
                        </div>
                    </div>
                    <div class="card-footer">
                      <input type="submit" value="Edit" class="btn btn-info" name="edit_item">
                    </div>
                </div>
            </form>
            <?php
      };
    };
       };
        ?>
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