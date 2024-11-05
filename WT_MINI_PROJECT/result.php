<?php
$nl=$_POST['tn'];

$ccn=0;
for($i=1;$i<=$nl;$i++)
{
    $ans=$_POST['ans_'.$i];
   
    $cn=$_POST['c_'.$i];
    if($ans==$cn)
    {
        $ccn=$ccn+1;
    }
   
}
echo "SUCCESSFULLY COMPLETED YOUR EXAM";

session_start();
$email=$_SESSION['email'];
$table=$_SESSION['table'];


$db_hostname = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "online_exam_results";
$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO `results`(`USER_NAME`, `EXAM_NAME`, `SCORE`) VALUES ('$email','$table','$ccn')";
        
if(mysqli_query($conn, $sql)) {
    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>