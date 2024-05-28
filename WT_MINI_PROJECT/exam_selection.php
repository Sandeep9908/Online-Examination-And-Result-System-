<?php
session_start();
?>
<html>
<head>
    <title>EXAM SELECTION PAGE</title>
    <link rel="stylesheet" href="exam_select.css">
</head>
<body>
    <h2 class="heading">PLEASE ENTER THE DETAILS</h2>
    <div class="user-exam">
        <form method="post" action="take_exam.php">
            <h2>ENTER YOUR NAME</h2>
            <input type="text" name="email"/>
            <label><h2>Select the exam</h2></label>
            <select name="EXAM">
                <option value="" disabled selected><h1>--select subject--</h1></option> 
                <?php
                // Connect to your database
                $conn = mysqli_connect("localhost", "root", "", "online_exam_and_result_system");
               
                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch table names from the database
                $sql = "SHOW TABLES";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // Output options for each table name
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row["Tables_in_online_exam_and_result_system"] . "'>" . $row["Tables_in_online_exam_and_result_system"] . "</option>";
                    }
                }
                // Close database connection
                mysqli_close($conn);
                ?>
            </select>
            <input type="submit" name="TAKE EXAM" value="TAKE EXAM" id=take_exam>
        </form>
    </div>
</body>
</html>
