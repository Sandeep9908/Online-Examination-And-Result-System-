<?php
// Database credentials
$db_hostname = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "online_exam_and_result_system";
$db_results_name = "online_exam_results";

// Create connection for exam database
$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Exam</title>
    <style>
        /* Base Reset */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h2 { color: #333; text-align: center; margin-bottom: 30px; font-size: 28px; }

        .form-container {
            max-width: 900px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease-in-out;
        }

        .form-container:hover { box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25); transform: translateY(-5px); }

        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #444;
            font-size: 14px;
        }

        .form-container input[type="text"] {
            width: 100%; padding: 14px; margin-bottom: 20px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-container input[type="text"]:focus {
            border-color: #6C63FF; box-shadow: 0 0 8px rgba(108, 99, 255, 0.4); outline: none;
        }

        .form-container hr { margin: 30px 0; border: none; height: 1px; background-color: #ddd; }

        .form-container input[type="submit"] {
            width: 100%; padding: 15px; background: linear-gradient(to right, #6C63FF, #3B3B98);
            color: #fff; border: none; border-radius: 8px;
            font-size: 18px; cursor: pointer; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .form-container input[type="submit"]:hover { background: linear-gradient(to right, #5A54D9, #3B3B98); transform: scale(1.02); }
        .form-container input[type="submit"]:active { transform: scale(0.98); }

        .success-message, .error-message {
            text-align: center; font-size: 18px; font-weight: 500; margin-top: 20px;
        }

        .success-message { color: #4caf50; }
        .error-message { color: #f44336; }
    </style>
</head>
<body>

<?php
// Modify Exam functionality
if (isset($_POST['modify_exam'])) {
    $exam_name = mysqli_real_escape_string($conn, $_POST['exam_name']);
    
    // Check if the exam (table) exists
    $sql_table_check = "SHOW TABLES LIKE '$exam_name'";
    $table_check_result = mysqli_query($conn, $sql_table_check);

    if (mysqli_num_rows($table_check_result) > 0) {
        // Fetch exam details (questions)
        $sql_fetch_exam = "SELECT * FROM $exam_name";
        $result = mysqli_query($conn, $sql_fetch_exam);

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="form-container">';
            echo "<h2>Modify Exam: $exam_name</h2>";
            echo '<form method="POST" action="">';

            // Display each question in the form for modification
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div>';
                echo '<label for="question'.$row['SL_NO'].'">Question '.$row['SL_NO'].':</label>';
                echo '<input type="text" id="question'.$row['SL_NO'].'" name="question'.$row['SL_NO'].'" value="'.$row['question'].'" required><br>';

                echo '<label for="obction1_'.$row['SL_NO'].'">Option 1:</label>';
                echo '<input type="text" id="obction1_'.$row['SL_NO'].'" name="obction1_'.$row['SL_NO'].'" value="'.$row['obction1'].'" required><br>';

                echo '<label for="obction2_'.$row['SL_NO'].'">Option 2:</label>';
                echo '<input type="text" id="obction2_'.$row['SL_NO'].'" name="obction2_'.$row['SL_NO'].'" value="'.$row['obction2'].'" required><br>';

                echo '<label for="obction3_'.$row['SL_NO'].'">Option 3:</label>';
                echo '<input type="text" id="obction3_'.$row['SL_NO'].'" name="obction3_'.$row['SL_NO'].'" value="'.$row['obction3'].'" required><br>';

                echo '<label for="obction4_'.$row['SL_NO'].'">Option 4:</label>';
                echo '<input type="text" id="obction4_'.$row['SL_NO'].'" name="obction4_'.$row['SL_NO'].'" value="'.$row['obction4'].'" required><br>';

                echo '<label for="correct_answer_'.$row['SL_NO'].'">Correct Answer:</label>';
                echo '<input type="text" id="correct_answer_'.$row['SL_NO'].'" name="correct_answer_'.$row['SL_NO'].'" value="'.$row['correct_answer'].'" required><br>';
                echo '</div><hr>';
            }

            echo '<input type="hidden" name="exam_name" value="'.$exam_name.'">';
            echo '<input type="submit" name="update_exam" value="Update Exam">';
            echo '</form>';
            echo '</div>';
        } else {
            echo '<div class="error-message">No questions found for the exam.</div>';
        }
    } else {
        echo '<div class="error-message">Exam not found!</div>';
    }
} elseif (isset($_POST['update_exam'])) {
    $exam_name = mysqli_real_escape_string($conn, $_POST['exam_name']);
    $update_success = true;

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'question') === 0) {
            $sl_no = str_replace('question', '', $key);
            $question = mysqli_real_escape_string($conn, $_POST["question$sl_no"]);
            $obction1 = mysqli_real_escape_string($conn, $_POST["obction1_$sl_no"]);
            $obction2 = mysqli_real_escape_string($conn, $_POST["obction2_$sl_no"]);
            $obction3 = mysqli_real_escape_string($conn, $_POST["obction3_$sl_no"]);
            $obction4 = mysqli_real_escape_string($conn, $_POST["obction4_$sl_no"]);
            $correct_answer = mysqli_real_escape_string($conn, $_POST["correct_answer_$sl_no"]);

            $sql_update_question = "UPDATE $exam_name 
                                    SET question='$question', obction1='$obction1', obction2='$obction2', obction3='$obction3', obction4='$obction4', correct_answer='$correct_answer'
                                    WHERE SL_NO='$sl_no'";

            if (!mysqli_query($conn, $sql_update_question)) {
                $update_success = false;
                echo '<div class="error-message">Error updating question '.$sl_no.': ' . mysqli_error($conn) . '</div>';
            }
        }
    }

    if ($update_success) {
        echo '<div class="success-message">Exam updated successfully!</div>';
    }
}

// Handle Delete Result
// Handle Delete Result
if (isset($_POST['delete_result'])) {
    $user_exam_data = $_POST['USER_NAME_EXAM_NAME'];

    // Connect to results database
    $conn_results = mysqli_connect($db_hostname, $db_username, $db_password, $db_results_name);
    if (!$conn_results) {
        die("Connection to results database failed: " . mysqli_connect_error());
    }

    // Delete the result
    $user_exam_data = mysqli_real_escape_string($conn_results, $user_exam_data);
    $sql_delete_result = "DELETE FROM results WHERE user_name='$user_exam_data' OR exam_name='$user_exam_data'";
    $delete_result = mysqli_query($conn_results, $sql_delete_result);

    if (mysqli_affected_rows($conn_results) > 0) {
        echo "<div class='success-message'>Result for $user_exam_data deleted successfully!</div>";
    } else {
        echo "<div class='error-message'>Result not found for $user_exam_data.</div>";
    }
}


// Close connection
mysqli_close($conn);
?>

</body>
</html>
