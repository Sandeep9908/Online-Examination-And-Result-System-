<?php
$db_hostname = "localhost";
$db_username = "root";
$db_password = "";

// Create connection
$conn = mysqli_connect($db_hostname, $db_username, $db_password);
if (!$conn) {
    echo "Connection failed: " . mysqli_connect_error();
    exit;
}

// ====== DATABASE 1: online_exam_login_data ======

// Create the first database
$sql = "CREATE DATABASE IF NOT EXISTS online_exam_login_data";
if (mysqli_query($conn, $sql)) {
    echo "Database online_exam_login_data created successfully or already exists.<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

// Select the first database
mysqli_select_db($conn, 'online_exam_login_data');

// Create user_login table in online_exam_login_data
$sql = "CREATE TABLE IF NOT EXISTS user_login (
    FIRST_NAME VARCHAR(50) NOT NULL,
    LAST_NAME VARCHAR(50) NOT NULL,
    MOBILE_NUMBER VARCHAR(15) NOT NULL,
    EMAIL_ID VARCHAR(100) NOT NULL PRIMARY KEY,
    ENTER_PASSWORD VARCHAR(255) NOT NULL,
    CONFORM_PASSWORD VARCHAR(255) NOT NULL
)";
if (mysqli_query($conn, $sql)) {
    echo "Table user_login created successfully in online_exam_login_data.<br>";
} else {
    echo "Error creating user_login table: " . mysqli_error($conn) . "<br>";
}

// Create admin_login table in online_exam_login_data
$sql = "CREATE TABLE IF NOT EXISTS admin_login (
    FIRST_NAME VARCHAR(50) NOT NULL,
    LAST_NAME VARCHAR(50) NOT NULL,
    MOBILE_NUMBER VARCHAR(15) NOT NULL,
    EMAIL_ID VARCHAR(100) NOT NULL PRIMARY KEY,
    ENTER_PASSWORD VARCHAR(255) NOT NULL,
    CONFORM_PASSWORD VARCHAR(255) NOT NULL
)";
if (mysqli_query($conn, $sql)) {
    echo "Table admin_login created successfully in online_exam_login_data.<br>";
} else {
    echo "Error creating admin_login table: " . mysqli_error($conn) . "<br>";
}

// ====== DATABASE 2: online_exam_and_result_system ======

// Create the second database
$sql = "CREATE DATABASE IF NOT EXISTS online_exam_and_result_system";
if (mysqli_query($conn, $sql)) {
    echo "Database online_exam_and_result_system created successfully or already exists.<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

// ====== DATABASE 3: online_exam_results ======

// Create the third database
$sql = "CREATE DATABASE IF NOT EXISTS online_exam_results";
if (mysqli_query($conn, $sql)) {
    echo "Database online_exam_results created successfully or already exists.<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

// Select the third database
mysqli_select_db($conn, 'online_exam_results');

// Create `results` table with attributes USER_NAME, EXAM_NAME, SCORE
$sql = "CREATE TABLE IF NOT EXISTS results (
    USER_NAME VARCHAR(100) NOT NULL,
    EXAM_NAME VARCHAR(100) NOT NULL,
    SCORE INT NOT NULL
)";
if (mysqli_query($conn, $sql)) {
    echo "Table results created successfully in online_exam_results.<br>";
} else {
    echo "Error creating results table: " . mysqli_error($conn) . "<br>";
}

// Close connection
mysqli_close($conn);
?>
