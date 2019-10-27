<?php
$fname = ""; // firstname
$lname = ""; // lastname
$em = ""; // email
$em2 = ""; // email 2
$password = ""; // password 
$password2 = ""; // password 2
$date = ""; // Sign Up date
$error_array = array(); // Holds error message

if(isset($_POST['register_button'])) {
// Registration form values
    // first name
    $fname = strip_tags($_POST['reg_fname']); // Remove html tags
    $fname = str_replace(' ','',$fname); // Remove white spaces
    $fname = ucfirst(strtolower($fname)); // uppercase first letter
    $_SESSION['reg_fname'] = $fname; // Stores first name into session variables
    // last name
    $lname = strip_tags($_POST['reg_lname']); // Remove html tags
    $lname = str_replace(' ','',$lname); // Remove white spaces
    $lname = ucfirst(strtolower($lname)); // uppercase first letter
    $_SESSION['reg_lname'] = $lname; // Stores last name into session variables
    // email
    $em = strip_tags($_POST['reg_email']); // Remove html tags
    $em = str_replace(' ','',$em); // Remove white spaces
    $em = ucfirst(strtolower($em)); // uppercase first letter
    $_SESSION['reg_email'] = $em; // Stores email into session variables
    // email 2
    $em2 = strip_tags($_POST['reg_email2']); // Remove html tags
    $em2 = str_replace(' ','',$em2); // Remove white spaces
    $em2 = ucfirst(strtolower($em2)); // uppercase first letter
    $_SESSION['reg_email2'] = $em2; // Stores email2 into session variables
    // password
    $password = strip_tags($_POST['reg_password']); // Remove html tags
    // password 2
    $password2 = strip_tags($_POST['reg_password2']); // Remove html tags
    // date
    $date = date("Y-m-d"); // get current date

    if($em == $em2){
        // check if email is in valid format
        if(filter_var($em,FILTER_VALIDATE_EMAIL)){
            $em = filter_var($em,FILTER_VALIDATE_EMAIL);
            // check if email already exists
            $e_check = mysqli_query($con,"SELECT email FROM users where email='$em'");
            // count the number of rows returned
            $num_rows = mysqli_num_rows($e_check);
            if($num_rows>0){
                array_push($error_array, "Email already in use.<br>");
            }

        }else{
                array_push($error_array,  "Invalid format!<br>");
        }
    }else{
                array_push($error_array,  "Emails don't match!!<br>");
    }

    if(strlen($fname) > 25 || strlen($fname) < 2 ){
        array_push($error_array, "Your first name must be between 2 and 25 characters.<br>");
    }
    if(strlen($lname) > 25 || strlen($lname) < 2 ){
        array_push($error_array, "Your last name must be between 2 and 25 characters.<br>");
    }
    if($password != $password2){
        array_push($error_array, "Your password don't match.<br>");
    }else{
        if(preg_match('/[^A-Za-z0-9]/',$password)){
            array_push($error_array, "Your password can contain only english characters or number.<br>");
        }
    }

    if(strlen($password) > 30 || strlen($password) < 5 ){
        array_push($error_array, "Your password must be between 5 and 30 characters.<br>");
    }

    if(empty($error_array)){
        $password = md5($password); // Encrypt the password before sending to database
        // Generate username by concating first name and last name
        $username = strtolower($fname . "_" . $lname);
        $check_username_query = mysqli_query($con,"SELECT username FROM users where username='$username'");

        $i = 0;
        // if username exists add number to username
        while(mysqli_num_rows($check_username_query)!=0){
            $i++;
            $username = $username . "_" . $i;
            $check_username_query = mysqli_query($con,"SELECT username FROM users where username='$username'");
        }

        // Profile picture assignment
        $rand = rand(1,2); // random number between 1 and 2
        if($rand == 1)
            $profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
        else if($rand == 2)
            $profile_pic = "assets/images/profile_pics/defaults/head_emrald.png";

        $query = mysqli_query($con,"INSERT INTO users VALUES ('','$fname','$lname','$username','$em','$password','$date','$profile_pic','0','0','no',',')");
        array_push($error_array,"<span style='color: #14C800;'>You are all set! Go ahead and login!</span><br>");
        // Clear session variables
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";
        
    }
   
}
?>