<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PrinceCircle</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>
<?php
    if(isset($_POST['register_button'])){
        echo "
        <script>
        $(document).ready(function() {
            $('#first').hide();
            $('#second').show();
        });
        </script>
        ";
    }

?>

<div class="wrapper">
    <div class="login_box">
        <div class="login_header">
            <h1>Prince Circle!</h1>
            Login or sign up below!
        </div>
        <div id="first">
    <form action="register.php" method="POST">
        <input type="email" name="log_email" placeholder="Email Address" value="<?php 
            if(isset($_SESSION['log_email'])){
                echo $_SESSION['log_email'];
            }
            ?>" required>
            <br>
        <input type="password" name="log_password" placeholder="Password">
        <br>
        <input type="submit" value="Login" name="login_button">
        <br>
        <?php if(in_array("Email or Password was incorrect.<br>",$error_array)) echo "Email or Password was incorrect.<br>"; ?>
        <a href="#" class="signup" id="signup">Need an account? Sign up here!</a>
</form>
</div>
    <div id="second">
    <form action="register.php" method="POST">
            <input type="text" name="reg_fname" placeholder="First Name" value="<?php 
            if(isset($_SESSION['reg_fname'])){
                echo $_SESSION['reg_fname'];
            }
            ?>" required>
        <br>
        <?php if(in_array("Your first name must be between 2 and 25 characters.<br>",$error_array)) echo "Your first name must be between 2 and 25 characters.<br>"; ?>
            <input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
            if(isset($_SESSION['reg_lname'])){
                echo $_SESSION['reg_lname'];
            }
            ?>" required>
            <br>
        <?php if(in_array("Your last name must be between 2 and 25 characters.<br>",$error_array)) echo "Your last name must be between 2 and 25 characters.<br>"; ?>
            <input type="email" name="reg_email" placeholder="Email" value="<?php 
            if(isset($_SESSION['reg_email'])){
                echo $_SESSION['reg_email'];
            }
            ?>" required>
        <br>
            <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
            if(isset($_SESSION['reg_email2'])){
                echo $_SESSION['reg_email2'];
            }
            ?>" required>
            <br>
        <?php if(in_array("Email already in use.<br>",$error_array)) echo "Email already in use.<br>"; 
         else if(in_array("Invalid format!<br>",$error_array)) echo "Invalid format!<br>"; 
         else if(in_array("Emails don't match!!<br>",$error_array)) echo "Emails don't match!!<br>"; ?>
        
    
            <input type="password" name="reg_password" placeholder="Password" required>
            <br>
            <input type="password" name="reg_password2" placeholder="Confirm Password" required>
            <br>
      
        <?php if(in_array("Your password don't match.<br>",$error_array)) echo "Your password don't match.<br>";
        else if(in_array("Your password can contain only english characters or number.<br>",$error_array)) echo "Your password can contain only english characters or number.<br>"; 
        else if(in_array("Your password must be between 5 and 30 characters.<br>",$error_array)) echo "Your password must be between 5 and 30 characters.<br>";?>

        <input type="submit" name="register_button" value="Register">
        <br>
        
        <?php if(in_array("<span style='color: #14C800;'>You are all set! Go ahead and login!</span><br>",$error_array)) echo "<span style='color: #14C800;'>You are all set! Go ahead and login!</span><br>"; ?>
        <a href="#" class="signin" id="signin">Already have an account? Sign in here!</a>
        </form>
        </div>
    </div>
   </div>
</body>
</html>