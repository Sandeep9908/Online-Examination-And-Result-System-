<?php
$db_hostname = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "online_exam_login_data";

$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
if (!$conn) {
    echo "Connection failed: " . mysqli_connect_error();
    exit;
}

$table = $_POST["data1"];
$email = $_POST["email"];
$password = $_POST["password"];

// Query to select the user based on the email
$sql = "SELECT * FROM $table WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Query failed: " . mysqli_error($conn);
    exit;
}

$user = mysqli_fetch_assoc($result);

if ($user) {
    // Directly compare the plain text password
    if ($password === $user['enter_password']) {
        echo "Your login is successfully completed";

        session_start();
        $_SESSION["last_name"] = $user["lastname"];
        $_SESSION["first_name"] = $user["firstname"];
        $_SESSION["Mobile_number"] = $user["mobilenumber"];
        $_SESSION["email"] = $user["email"];

        echo $_SESSION["Mobile_number"];

        if ($table == "user_login") {
            $_SESSION['ts'] = "User";
            header("Location: User_frame_set.html");
        } else {
            $_SESSION['ts'] = "Admin";
            header("Location: Admin_frame_set.html");
        }
    } else {
        echo '<script>alert("Invalid password")</script>';
        echo '<script>window.location.href = "Login page.html";</script>';
    }
} else {
    echo '<script>alert("Invalid email")</script>';
    echo '<script>window.location.href = "Login page.html";</script>';
}

mysqli_close($conn);
?>
