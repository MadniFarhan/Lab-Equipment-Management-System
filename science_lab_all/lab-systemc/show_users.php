<?php include "includes/header.php"; ?>

<?php  
  if($_SESSION['user_type'] !== "admin")
  {
    header("Location: index.php");
    exit();
  }
 ?>
 <?php
require "includes/database_config.php";

if(isset($_POST['approve'])) {
    $user_id = $_POST['user_id'];
    // Update user status to approved
    $sql = "UPDATE users SET user_type = 'student' WHERE id = '$user_id'";
    if($conn->query($sql) === TRUE) {
        // Redirect to the confirmation page
        header("Location: show_users.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif(isset($_POST['reject'])) {
  
    $user_id = $_POST['user_id'];
    // Delete the user from the database
    $sql = "DELETE FROM users WHERE id = '$user_id'";

    if($conn->query($sql) === TRUE) {
        // Redirect to the confirmation page
        header("Location: show_users.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// $conn->close();
?>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
            <div class="offset-2 col-lg-8 offset-2">
              <?php
              echo errorFunction();
              echo successFunction();
             ?>
              <div class="card">
                <div class="card-header">
                  <h2 class="float-left">Users</h2>
                  <a href="add_users.php" class="btn btn-info float-right">Add User</a>
                </div>
                <table class="table table-bordered  table-striped table-hover">
                  <thead class="thead-dark">
                    <tr class="text-center">
                      <th>Sr. No.</th>
                      <th>Name</th>
                      <th>Roll Number</th>
                      <th>Email</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM `users` ORDER BY `id` DESC";
                    $result = $conn->query($sql);

                    if($result->num_rows > 0)
                    {
                      $sr = 0;
                      while ($record = $result->fetch_assoc()) 
                      {
                        $sr++;
                        ?>
                        <tr>
                          <td><?php echo $sr; ?></td>
                          <td><?php echo $record['name']; ?></td>
                          <td><?php echo $record['roll_number']; ?></td>
                          <td><?php echo $record['email']; ?></td>
                          <td>
                            <a href="edit_user.php?user_id=<?php echo $record['id']; ?>" class="btn btn-warning" style="margin-left: 15px; color:white;">Edit</a>
                            <a href="delete_user.php?user_id=<?php echo $record['id']; ?>" class="btn btn-danger">Delete</a>
                          </td>
                        </tr>
                        <?php
                      }
                    }
                    ?>
                      <?php
                    $sql = "SELECT * FROM users WHERE user_type = 'pending'";
                    $result = $conn->query($sql);

                    if($result->num_rows > 0)
                    {
                      $sr = 0;
                      while ($record = $result->fetch_assoc()) 
                      {
                        $sr++;
                        ?>
                        <tr>
                          <td><?php echo $sr; ?></td>
                          <td><?php echo $record['name']; ?></td>
                          <td><?php echo $record['roll_number']; ?></td>
                          <td><?php echo $record['email']; ?></td>
                          <td>
                             <form action='#' method='POST'>
       <form action="#" method="POST">
            <input type="hidden" name="user_id" value="<?php echo $record['id']; ?>">
            <button type="submit" name="approve" class="btn btn-success">Approve</button>
            <button type="submit" name="reject" class="btn btn-primary">Reject</button>
        </form>
        <hr>
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

