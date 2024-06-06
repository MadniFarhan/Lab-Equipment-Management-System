<?php include "includes/header.php"; 

	if (isset($_GET['user_id'])) 
	{
		$user_id = $_GET['user_id'];
		try
		{
			$sql = "DELETE FROM reservations WHERE user_id = {$user_id};";
			$sql .= "DELETE FROM `users` WHERE id = {$user_id};";
			$sql .= "UPDATE `equipment` SET `device_status` = 'available',
				`user_id` = 0 
				 WHERE `user_id` = {$user_id};";
			if($conn->multi_query($sql))
			{
	         	$_SESSION['SuccessMessage'] = "Successfully Deleted!!";
				if(isset($_SERVER['HTTP_REFERER'])) 
				{
				    $previous = $_SERVER['HTTP_REFERER'];
				    header("Location: {$previous}");
				    exit;
				}
				else
				{
					echo "error";
				}

			}
		}
		catch(Exception $e)
		{
			$_SESSION['ErrorMessage'] = "User cannot be deleted because it has a link with other records!!";
	         	header("Location: {$_SERVER['HTTP_REFERER']}");
	         	exit;
		}
		
		
	}



?>
