<?php
session_start();
$selected_exam = $_SESSION['EXAM']; // Assuming 'EXAM' is the name of your select input

$conn = mysqli_connect("localhost", "root", "", "online_exam_and_result_system");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Assuming each exam corresponds to a table in your database
$sql = "SELECT * FROM $selected_exam"; // Assuming your table names are the same as your exam names
$result = mysqli_query($conn, $sql);

?>

<html>
<head>
    <style>

        h1{
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
        }
        table {
            width: 70%;
            border-collapse: collapse;
            margin: auto;
            margin-bottom: 15px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .question {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .correct {
            background-color: #c8e6c9; /* Light green */
        }
    </style>
</head>
<body>
    <h1>EXAMINATION REVIEW</h1>
    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch data from the selected table
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <table border="1" >
                <tr class="question">
                    <td><?php echo "$row[SL_NO]. $row[question]";?></td>
                </tr>
                <tr <?php if ($row['correct_answer'] == $row['obction1']) echo 'class="correct"'; ?>>
                    <td><?php echo "$row[obction1]"; ?></td>
                </tr>
                <tr <?php if ($row['correct_answer'] == $row['obction2']) echo 'class="correct"'; ?>>
                    <td><?php echo "$row[obction2]"; ?></td>
                </tr>
                <tr <?php if ($row['correct_answer'] == $row['obction3']) echo 'class="correct"'; ?>>
                    <td><?php echo "$row[obction3]"; ?></td>
                </tr>
                <tr <?php if ($row['correct_answer'] == $row['obction4']) echo 'class="correct"'; ?>>
                    <td><?php echo "$row[obction4]"; ?></td>
                </tr>
            </table>
            <?php
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    ?>
</body>
</html>

<?php
mysqli_close($conn);
?>
