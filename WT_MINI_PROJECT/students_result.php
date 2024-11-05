<?php
$conn = mysqli_connect("localhost", "root", "", "online_exam_results");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch distinct exam names from the results table
$sql_distinct_exams = "SELECT DISTINCT EXAM_NAME FROM results";
$result_distinct_exams = mysqli_query($conn, $sql_distinct_exams);

// Check if there are any distinct exam names
if (mysqli_num_rows($result_distinct_exams) > 0) {
    // Loop through each distinct exam name
    while ($row_distinct_exams = mysqli_fetch_assoc($result_distinct_exams)) {
        $exam_name = $row_distinct_exams['EXAM_NAME'];
        // Fetch data for each exam name
        $sql_exam_data = "SELECT * FROM results WHERE EXAM_NAME = '$exam_name'";
        $result_exam_data = mysqli_query($conn, $sql_exam_data);
?>
        <html>
        <head>
            <title><?php echo $exam_name; ?> Details</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
                h2 {
                    color: #1a237e;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    padding: 10px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }
                th {
                    background-color: lightslategray;
                }
                tr:nth-child(even) {
                    background-color: #f2f2f2;
                }
                tr:hover {
                    background-color: #ddd;
                }
            </style>
        </head>
        <body>
            <h2><?php echo $exam_name; ?> Details</h2>
            <?php
            if (mysqli_num_rows($result_exam_data) > 0) {
            ?>
                <table border='1'>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Score</th>
                    </tr>
                    <?php
                    while ($row_exam_data = mysqli_fetch_assoc($result_exam_data)) {
                    ?>
                        <tr>
                            <td><?php echo $row_exam_data['USER_NAME']; ?></td>
                            <td><?php echo $row_exam_data['EXAM_NAME']; ?></td>
                            <td><?php echo $row_exam_data['SCORE']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            <?php
            } else {
                echo "No results found for $exam_name.";
            }
            ?>
        </body>
        </html>
<?php
    }
} else {
    echo "No exams found.";
}
?>
