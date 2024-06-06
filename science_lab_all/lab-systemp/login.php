<?php

  require "includes/database_config.php";
  include "includes/sessions.php";

  if(isset($_POST['signup_submit'])) {
    $name = $_POST['name'];
    $roll_number = $_POST['roll'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Insert the user into the database
    $sql ="INSERT INTO `users` SET `name` = '{$name}', 
           `roll_number` = '{$roll_number}',`email` = '{$email}',
           `password` = '{$password}', `user_type` = 'pending'";
    if($conn->query($sql) === TRUE) {
        // Redirect to a confirmation page
        echo "<script>alert('Your request has been sent to the admin for approval.');</script>";
        // header("Location: login.php");
        // exit();

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// $conn->close();


  // if (isset($_SESSION['name'])) 
  // {
  //        // $_SESSION['ErrorMessage'] = "Logout Required To Access This page!";
  //       // header("Location: index.php");
  //       // exit();
  // }
  if(isset($_POST['login_submit']))
  {
  	extract($_POST);
      $email = htmlspecialchars($email);
  	$password = htmlspecialchars($password);
  	$sql = "SELECT * FROM `users` where `email` = '{$email}' AND 
  			`password` = '{$password}' LIMIT 1";
  	$result = $conn->query($sql);		
  	if($result->num_rows == 1)
  	{
  		$user = $result->fetch_assoc();

  		  $_SESSION['id'] = $user['id'];
  		  $_SESSION['email'] = $user['email'];
  		  $_SESSION['name'] = $user['name'];
  		  $_SESSION['user_type'] = $user['user_type'];
  		  // if($_SESSION['user_type'] == "admin")
  		  // {
  		  // 	header("Location: index.php");
  		  // }


  		  //  }
  		  //  else {
  		  //  echo "<script>alert('username or password is incorrect')</script>";
  		  //  }
 
if (!isset($_SESSION['id'])) {
  header("Location: login.php");
  exit();
} elseif ($_SESSION['user_type'] == "admin") {
  header("Location: index.php");
  exit();
} elseif ($_SESSION['user_type'] == "pending") {
  
  header("Location: login.php");
  exit();
} elseif ($_SESSION['user_type'] !== "student") {
  // For any other user_type, redirect to login page
  header("Location: login.php");
  exit();
} elseif ($_SESSION['user_type'] == "student") {
  header("Location: reserve_item.php");
  exit();
}
} else {
  echo "<script>alert('You can not login because your reqrest has been rejected.');</script>";
}
}
    
  
?>
<!-- <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Loginform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
</head>
<body>
<div class="container">

<div class="container">
    <div class="row">
        <div class="contcustom">
            <span class="fa fa-user bigicon"></span>
            <h2>Login Form</h2>          
            <div>
			    <form action="" method="POST">
                 <div class="error"></div>
                 <input type="email" placeholder="Email" name="email" id="email" autofocus />
                 <input type="password" placeholder="Password" name="password" id="password" />
		         <button class="btn btn-default wide" type="submit" name="submit" class="btn btn-primary"><span class="fa fa-lock med"> login</span></button>       
       	        </form>
            </div>         
        </div>
    </div>
</div>


<style>
body {
    background-color: #F0EEEE;
}

.row {
    padding:20px 0px;
    margin-top: 5%;
}

.bigicon {
    font-size:95px;
    color: #f96145;
}

.contcustom {
    text-align: center;
    width: 300px;
    border-radius: 0.5rem;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: 10px auto;
    background-color: white;
    padding: 20px;
}   

input {
    width: 90%;
    margin-bottom: 17px;
    padding: 15px;
    background-color: #ECF4F4;
    border-radius: 4px;
    border: none;
}

h2 {
    margin-bottom: 20px;
    font-weight: bold;
    color: #ABABAB;
}

.btn {
    border-radius: 4px;
    padding: 10px;     
}

.med {
    font-size: 27px;
    color: white;
}

.wide{
    background-color: #8EB7E4;
    width: 100%;
   
}
</style>



</div>

</body>
</html
 -->











<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login & Signup Form</title>
    <link rel="stylesheet" href="LoginStyles.css" />
    
  </head>
  <body>
    <?php if(isset($error)): ?>
    <div><?php echo $error ?></div>
    <?php endif; ?>
     
    <section class="wrapper">
      <div class="form signup" >
        <header>Signup</header>
        <form action="#" id="m3" method="POST">
            <input type="text" name="name" placeholder="Full name" required />
            <input type="text" name="roll" placeholder="Enter roll No" required />
            <input type="text" name="email" placeholder="Email address" required />
            <input type="password" name="password" placeholder="Password" required />
          <div class="checkbox">
              <input type="checkbox" name="check" id="signupCheck" />
            <label for="signupCheck">I accept all terms & conditions</label>
          </div>
          <input name="signup_submit" type="submit" value="Signup" />
        </form>
      </div>

      <div class="form login" >
        <header>Login</header>
        <form action="#" id="m4" method="POST">
            <input type="email" name="email" placeholder="email" required />
          <input type="password" name="password" placeholder="Password" required />
          <a href="#">Forgot password?</a>
          <input name="login_submit" type="submit" value="Login" />
        </form>
      </div>
           <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" ></script>
    <script src="log1.js" ></script>
    <script >
      const wrapper = document.querySelector(".wrapper"),
          signupHeader = document.querySelector(".signup header"),
          loginHeader = document.querySelector(".login header");

        loginHeader.addEventListener("click", () => {
          wrapper.classList.add("active");
        });
        signupHeader.addEventListener("click", () => {
          wrapper.classList.remove("active");
        });
    </script>


       
 
    </section>
        
  </body>
  
</html>
