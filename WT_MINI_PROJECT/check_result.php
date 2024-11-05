<?php
    $db_hostname = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "online_exam_results";
    $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $user_name = $_POST['name'];
    $exam = $_POST['EXAM'];


    $sql = "SELECT * FROM results WHERE USER_NAME='$user_name' AND EXAM_NAME='$exam'";
    $data = mysqli_query($conn, $sql);

    if (mysqli_num_rows($data) > 0) { // Check if there are any rows returned
        $row = mysqli_fetch_assoc($data);

        session_start();
        $_SESSION['EXAM']=$row['EXAM_NAME'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Exam Result</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        table {
            width: 50%;
            margin: 10% auto;
            font-size: 24px;
            text-align: center;
            border-collapse: collapse;
            background-color: #ffffff;
            border: 2px solid #007bff;
            border-radius: 10px;
        }
        th {
            background-color: #007bff;
            color: #ffffff;
            padding: 15px;
            border-bottom: 2px solid #ffffff;
        }
        th:first-child {
            border-top-left-radius: 10px;
        }
        th:last-child {
            border-top-right-radius: 10px;
        }
        td {
            padding: 15px;
            border-bottom: 1px solid #dddddd;
        }
        td:first-child {
            font-weight: bold;
        }
        .score {
            color: #28a745;
            font-weight: bold;
        }

        .submit-btn {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .form-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th colspan="2">ONLINE EXAM RESULT</th>
        </tr>
        <tr>
            <td>NAME</td>
            <td><?php echo $row['USER_NAME'] ?></td>
        </tr>
        <tr>
            <td>EXAM NAME</td>
            <td><?php echo $row['EXAM_NAME'] ?></td>
        </tr>
        <tr>
            <td>SCORE</td>
            <td class="score"><?php echo $row['SCORE'] ?></td>
        </tr>
    </table>
    <form method="post" action="result_analysis.php" class="form-container">
        <input type="submit" name="submit_analysis" value="View Result Analysis" class="submit-btn">
    </form>
</body>
</html>
<?php
    } else {
        echo "DATA NOT FOUND";
    }

    mysqli_close($conn);
?>
