<?php include "includes/header.php"; ?>
<?php  
  if($_SESSION['user_type'] !== "admin")
  {
    header("Location: index.php");
    exit();
  }
 ?>
  
<?php

  if(isset($_POST['save_user']))
  {
    extract($_POST);
    if(empty($uname) || empty($email) || empty($password) || empty($roll_number))
    {
      
  if(strlen(trim($password)) > 8)
   {
   echo"Password must be 8characters";
   }
      $_SESSION['ErrorMessage'] = "Fields should not be empty!!";
    }
    else
    {
      $sql = "SELECT `email` FROM `users` Where 
          `email` = '{$email}'";
          $result = $conn->query($sql);
        if($result->num_rows > 0)
        {
          $_SESSION['ErrorMessage'] = "Username already exist!!";
          
        }
        else
        {
            $sql = "INSERT INTO `users` SET `name` = '{$uname}', 
           `roll_number` = '{$roll_number}',`email` = '{$email}',
           `password` = '{$password}', `user_type` = '{$user_type}'";
           if($conn->query($sql))
           {
             $_SESSION['SuccessMessage'] = "Successfully inserted!!";
             
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
                      <h3 class="card-title">Registration Form</h3>
                      <a href="show_users.php" class="float-right btn btn-info">Back to Listing</a>
                    </div>
                    <div class="card-body">
                      <label for="exampleInputEmail1">Name:</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">@</span>
                        </div>
                        <input type="text" name="uname" class="form-control" placeholder="Enter your name">
                      </div>
                      <label for="exampleInputEmail1">Roll Number:</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="roll_number" class="form-control" placeholder="Enter your roll number">
                      </div>
                      <label for="exampleInputEmail1">Email address</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                      </div>

                      <label for="exampleInputEmail1">Password</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="*****" required>
                      </div>

                      <div class="form-group">
                            <label>Select user type</label>
                            <select class="form-control" name="user_type">
                              <option value="student">Student</option>
                              <option value="admin">Admin</option>
                            </select>
                      </div>
                    </div>
                    <div class="card-footer">
                      <input type="submit" value="Save" class="btn btn-info" name="save_user">
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