<?php
include "includes/header.php";

if ($_SESSION['user_type'] !== "admin") {
    header("Location: index.php");
    exit();
}

if (isset($_POST['edit_user'])) {
    $update_id = $_GET['user_id']; // Assuming you are passing the user_id through the URL
    $update_name = mysqli_real_escape_string($conn, $_POST['uname']);
    $update_roll_number = mysqli_real_escape_string($conn, $_POST['roll_number']);
    $update_email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "UPDATE `users` SET name = '$update_name', roll_number = '$update_roll_number', email = '$update_email' WHERE id = '$update_id'";

    if ($conn->query($sql)) {
        $_SESSION['SuccessMessage'] = "Updated Successfully!!";
    } else {
        $_SESSION['ErrorMessage'] = "Error: " . $conn->error;
    }
}

?>

<?php
   
   
    if(isset($_GET['user_id'])){
       $edit_id = $_GET['user_id'];
       $edit_query = mysqli_query($conn, "SELECT * FROM `users` WHERE id = $edit_id");
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
            <form action="" method="POST">
                <div class="card card-info">
                    <div class="card-header" style="background-color: #4f5962;">
                      <h3 class="card-title">Edit Registration Form</h3>
                      <a href="show_users.php" class="float-right btn btn-info">Back to listing</a>
                    </div>
                    <div class="card-body">
                      <label for="exampleInputEmail1">Name:</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">@</span>
                        </div>
                        <input type="text" name="uname" class="form-control" value="<?php echo $fetch_edit['name']; ?>" placeholder="Enter your name">
                      </div>
                      <label for="exampleInputEmail1">Roll Number:</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="roll_number" class="form-control" value="<?php echo $fetch_edit['roll_number']; ?>" placeholder="Enter your roll number">
                      </div>
                      <label for="exampleInputEmail1">Email address</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" class="form-control" value="<?php echo $fetch_edit['email']; ?>" placeholder="Enter your email" required>
                      </div>

                    </div>
                    <div class="card-footer">
                      <input type="submit" value="Edit" class="btn btn-info" name="edit_user">
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