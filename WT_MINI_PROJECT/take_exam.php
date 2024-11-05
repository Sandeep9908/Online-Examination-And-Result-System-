<?php 
session_start();
$_SESSION['email']=$_POST['email'];
$_SESSION['table']=$_POST['EXAM'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Exam</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: beige;
        }
        table {
            width: 65%;
            margin: 0 auto;
            font-size: 18px;
            border-collapse: collapse;
            background-color: white;
        }
        th, td {
            border: 2px solid #007bff;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: #ffffff;
        }
        input[type="radio"] {
            margin-right: 10px;
        }
        input[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #ffffff;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form method="post" action="result.php">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "online_exam_and_result_system");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $exam = $_POST['EXAM'];

            $length = "SELECT COUNT(*) AS total_length FROM $exam";
            $t_length = mysqli_query($conn, $length);

            if(mysqli_num_rows($t_length) > 0){
                $row = mysqli_fetch_assoc($t_length);
                $total_length = $row['total_length'];
            }
        }
        ?>
        <input type="hidden" name="tn" value="<?php echo $total_length;?>">
        <?php
        $sql = "SELECT * FROM $exam";
        $data = mysqli_query($conn, $sql);

        if($data){
            for($i = 1; $i <= $total_length; $i++){
                $row = mysqli_fetch_assoc($data);
        ?>
            <table>
                <tr>
                    <th colspan="2"><?php echo $i; ?>) <?php echo $row['question']; ?></th>
                </tr>
                <tr>
                    <td><input type="radio" name="ans_<?php echo $i; ?>" value="<?php echo $row['obction1']; ?>">
                    <?php echo $row['obction1']; ?></td>
                </tr>
                <tr>
                    <td><input type="radio" name="ans_<?php echo $i; ?>" value="<?php echo $row['obction2']; ?>">
                    <?php echo $row['obction2']; ?></td>
                </tr>
                <tr>
                    <td><input type="radio" name="ans_<?php echo $i; ?>" value="<?php echo $row['obction3']; ?>">
                    <?php echo $row['obction3']; ?></td>
                </tr>
                <tr>
                    <td><input type="radio" name="ans_<?php echo $i; ?>" value="<?php echo $row['obction4']; ?>">
                    <?php echo $row['obction4']; ?></td>
                </tr>
            </table>
            <input type="hidden" name="c_<?php echo $i; ?>" value="<?php echo $row['correct_answer']; ?>">
            <br><br>
        <?php
            }
        }
        mysqli_close($conn);
        ?>
        <center><input type="submit" value="Submit"></center>
    </form>
</body>
</html>
