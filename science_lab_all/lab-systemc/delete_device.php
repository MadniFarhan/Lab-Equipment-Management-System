<?php include "includes/header.php"; 

	if (isset($_GET['device_id'])) 
	{
		try
		{
			$sql = "DELETE FROM `equipment` WHERE `id` = {$_GET['device_id']}";
			if($conn->query($sql))
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
	         	$_SESSION['ErrorMessage'] = "Device cannot be deleted because it has a link with other records!!";
	         	header("Location: {$_SERVER['HTTP_REFERER']}");
	         	exit;

		}

			
	}



?>
