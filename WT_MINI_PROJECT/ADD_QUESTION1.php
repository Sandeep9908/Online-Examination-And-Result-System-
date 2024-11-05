<?php $n=$_POST["Total_Questions"];
   $q1name=$_POST["Quiz_Name"];
?>

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

$qname = mysqli_real_escape_string($conn, $q1name);


// Check if table exists
$table_check_sql = "SHOW TABLES LIKE '$qname'";
$table_check_result = mysqli_query($conn, $table_check_sql);

if (mysqli_num_rows($table_check_result) > 0) {
    // Table already exists
    echo "<script>alert('Exam already exists');</script>";
    echo "<script>window.location.href='create exam.html';</script>";

}
else{

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .question_paper{
             background-color: aliceblue;
             display: flex;
             position: relative;
             margin: 10px;
        }
        .add_question{
            font-weight: bold;
            font-size: 100%;
            background-color: antiquewhite;
            margin: 2%;
            padding: 2%;
            width: 100%;

        }
        .add_question label{
            display: flex;
        }
       
    </style>
</head>
<body>
    
    <div class="question_paper">
        <div class="add_question">
            <form action="ADD_QUESTION.php" method="post">
                <input type="hidden" name='total' value="<?php echo $n;  ?>">
                <input type="hidden" name='qname' value="<?php echo $qname; ?>">
            <?php
            
                for ($i = 1; $i <=$n; $i++) {
   
            ?>    
                <?php
                echo "<br>";
                echo "<br>";
                echo $i; ?>
                <input type="hidden" name='tq<?php echo $i ?>' value="<?php echo $i ?>">

                <label>ADD QUESTION</label>
                <input type="text" id="question"  name="question<?php echo $i;?>">
           
                <label >obctions</label>
                <input type="text" id="o1" name="obction1<?php echo $i ?>">
                <input type="text" id="o2" name="obction2<?php echo $i ?>">
                <input type="text" id="o3" name="obction3<?php echo $i ?>">
                <input type="text" id="o4" name="obction4<?php echo $i ?>">

                <label>Correct Answer</label>
                <input type="text" id="correct_answer" name="correct_answer<?php echo $i ?>">
                <?php
        } 
    ?>
                <br><input type="submit" value="SAVE">
            </form>
        </div>
    </div>
    
</body>
</html>
<?php
}
?>