<?php
$db_hostname = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "online_exam_login_data";

// Create connection using object-oriented style
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$mobile_number = $_POST["Mobile_number"];
$email = $_POST["email"];
$password = $_POST["password"];
$conform_password = $_POST["Conform_password"];
$table = $_POST["data"];

// Validate and sanitize user inputs
if ($password !== $conform_password) {
    die("Passwords do not match.");
    exit;
}

// // Hash the password
// $hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare the SQL statement with correct column names
$sql = "INSERT INTO $table (firstname, lastname, mobilenumber, email, enter_password, conform_password) VALUES ('$first_name', '$last_name', '$mobile_number', '$email', '$password', '$conform_password')";

if ($conn->query($sql) === TRUE) {
    echo '<script>window.location.href = "Login page.html";</script>';
    // echo "Success";
} else {
    echo "Unsuccessful: " . $conn->error;
}
$conn->close();
?>
