<?php include "includes/header.php"; 

	if (isset($_GET['device_id']) && isset($_GET['res_id'])) 
	{
		$device_id = $_GET['device_id'];
		$res_id = $_GET['res_id'];
		$sql = "UPDATE `equipment` SET `device_status` = 'available',
				`user_id` = 0 
				 WHERE `id` = {$device_id};";
		$sql .= "UPDATE `reservations` SET `is_cancelled` = 1 
				 WHERE `id` = {$res_id} AND `device_id` = {$device_id}";
		if($conn->multi_query($sql))
		{
         	$_SESSION['SuccessMessage'] = "Reservation Cancelled Successfully!!";
			if(isset($_SERVER['HTTP_REFERER'])) 
			{
			    $previous = $_SERVER['HTTP_REFERER'];
			    header("Location: {$previous}");
			    exit;
			}
			
		}
		else
		{
			$_SESSION['ErrorMessage'] = "something went wrong with query!!";
		}
	}



?>
