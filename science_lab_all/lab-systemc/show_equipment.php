<?php include "includes/header.php"; ?>
<?php  
if($_SESSION['user_type'] !== "admin" && $_SESSION['user_type'] !== "student")
{
  header("Location: index.php");
  exit();
}
?>


<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="offset-1 col-lg-10">
        <?php
        echo errorFunction();
        echo successFunction();
        ?>
        <div class="card" style="width: 107%;">
          <div class="card-header">
            <h2 class="float-left">Devices</h2>
            <?php if($_SESSION['user_type'] == "admin") { ?>
              <a href="add_equipment.php" class="btn btn-info float-right">Add device</a>
            <?php } ?>
          </div>
          <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
              <tr class="text-center">
                <th>Sr. No.</th>
                <th>Device Name</th>
                <th>Device Image</th>
                <th>Device quantity</th>
                <th>Remaining Quantity</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT DISTINCT id, device_name, device_image, quantity, remaining_quantity, device_status, created_at FROM `equipment` ORDER BY `id` DESC";
              $result = $conn->query($sql);
              if($result->num_rows > 0)
              {
                $sr = 0;
                while ($record = $result->fetch_assoc()) 
                {
                  $sr++;
                  extract($record);
                  $rowStyle = ($device_status == 'reserved') ? 'background-color: #ffcccb;' : '';
              ?>
              <tr class="text-center" style="<?php echo $rowStyle; ?>">
                <td><?php echo $sr; ?></td>
                <td><?php echo $device_name; ?></td>
                <td><img width="80px" src="uploads/<?php echo $device_image; ?>"></td>
                <td><?php echo $quantity; ?></td>
                <td><?php echo $remaining_quantity; ?></td>
                <td><?php echo $device_status; ?></td>
                <td><?php echo $created_at; ?></td>
                <td>
                  <a href="device_detail.php?device_id=<?php echo $id; ?>" class="btn btn-info">View</a>
                  <?php if($_SESSION['user_type'] == "admin") { ?>
                    <a href="edit_equipment.php?device_id=<?php echo $id; ?>" class="btn btn-warning">Edit</a>
                    <a href="delete_device.php?device_id=<?php echo $id; ?>" class="btn btn-danger">Delete</a>
                  <?php } ?>
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
