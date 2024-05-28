<?php
$db_hostname = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "online_exam_and_result_system";
$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$qname = mysqli_real_escape_string($conn, $_POST['qname']);
$nn = (int)$_POST['total'];

// Check if table exists
$table_check_sql = "SHOW TABLES LIKE '$qname'";
$table_check_result = mysqli_query($conn, $table_check_sql);

if (mysqli_num_rows($table_check_result) > 0) {
    // Table already exists
    echo "<script>alert('Exam already exists');</script>";
} else {
    // Create table
    $sql = "CREATE TABLE `$qname` (
        SL_NO INT,
        question VARCHAR(255),
        obction1 VARCHAR(255),
        obction2 VARCHAR(255),
        obction3 VARCHAR(255),
        obction4 VARCHAR(255),
        correct_answer VARCHAR(255)
    )";

    if(mysqli_query($conn, $sql)) {
       
    } else {
        echo "Error creating table: " . mysqli_error($conn) . "<br>";
    }

    // Insert questions
    for ($i = 1; $i <= $nn; $i++) {
        $question_number = $_POST['tq' . $i];
        $question = mysqli_real_escape_string($conn, $_POST['question' . $i]);
        $obction1 = mysqli_real_escape_string($conn, $_POST['obction1' . $i]);
        $obction2 = mysqli_real_escape_string($conn, $_POST['obction2' . $i]);
        $obction3 = mysqli_real_escape_string($conn, $_POST['obction3' . $i]);
        $obction4 = mysqli_real_escape_string($conn, $_POST['obction4' . $i]);
        $correct_answer = mysqli_real_escape_string($conn, $_POST['correct_answer' . $i]);

        $sql = "INSERT INTO `$qname` (SL_NO, question, obction1, obction2, obction3, obction4, correct_answer) 
                VALUES ('$question_number', '$question', '$obction1', '$obction2', '$obction3', '$obction4', '$correct_answer')";
        
        if(mysqli_query($conn, $sql)) {
            
        } else {
            echo "Error inserting question: " . mysqli_error($conn) . "<br>";
        }
    }
    echo "<script>alert('Exam created successfully');</script>";
}
mysqli_close($conn);
?>
