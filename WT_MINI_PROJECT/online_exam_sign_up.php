<?php
    $db_hostname = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "online_exam_login_data";
    $conn = new mysqli($db_hostname, $db_username, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $first_name=$_POST["first_name"];
    $last_name=$_POST["last_name"];
    $Mobile_number=$_POST["Mobile_number"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $Conform_password=$_POST["Conform_password"];
    
    $table=$_POST["data"];
    // Validate and sanitize user inputs
    // $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
    // $last_name = mysqli_real_escape_string($conn, $_POST["last_name"]);
    // $Mobile_number = mysqli_real_escape_string($conn, $_POST["Mobile_number"]);
    // $email = mysqli_real_escape_string($conn, $_POST["email"]);
    // $password = mysqli_real_escape_string($conn, $_POST["password"]);
    // $Conform_password = mysqli_real_escape_string($conn, $_POST["Conform_password"]);

    // Check if passwords match
    if ($password !== $Conform_password) {
        die("Passwords do not match");
    }

    $sql="INSERT INTO $table (FIRST_NAME, LAST_NAME, MOBILE_NUMBER, EMAIL_ID, ENTER_PASSWORD, CONFORM_PASSWORD) VALUES ('$first_name','$last_name','$Mobile_number','$email','$password','$Conform_password')";
    // $result = $conn->query($sql);

    if($conn->query($sql))
    {
        echo "login details are sucessfully saved";
    }
    else{
        echo("login unsuccessfully");
    }
    mysqli_close($conn);


?>