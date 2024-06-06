<?php include "includes/header.php"; 

if (isset($_GET['device_id']) && isset($_GET['res_id'])) {
    $device_id = $_GET['device_id'];
    $res_id = $_GET['res_id'];

    $sql = "UPDATE `equipment` SET 
                `device_status` = 
                    CASE
                        WHEN remaining_quantity + 1 >= quantity THEN 'available'
                        ELSE `device_status`
                    END,
                `user_id` = 0,
                `remaining_quantity` = 
                    CASE
                        WHEN remaining_quantity < quantity THEN remaining_quantity + 1
                        ELSE remaining_quantity
                    END
            WHERE `id` = {$device_id};";

    $sql .= "UPDATE `reservations` SET `is_returned` = 1 
             WHERE `id` = {$res_id} AND `device_id` = {$device_id}";

    if($conn->multi_query($sql)) {
        $_SESSION['SuccessMessage'] = "Device Returned Successfully!!";
        if(isset($_SERVER['HTTP_REFERER'])) {
            $previous = $_SERVER['HTTP_REFERER'];
            header("Location: {$previous}");
            exit;
        }
    } else {
        $_SESSION['ErrorMessage'] = "Something went wrong with the query!!";
    }
}
?>
