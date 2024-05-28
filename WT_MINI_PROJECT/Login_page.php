<?php
 $db_hostname="localhost";
 $db_username="root";
 $db_password="";
 $db_name="online_exam_login_data";
  $conn=mysqli_connect($db_hostname,$db_username,$db_password,$db_name);
  if(!$conn){
    echo "connection failed" .mysqli_connect_error();
    exit;
  }
  $table=$_POST["data1"];
  
  $email=$_POST["email"];
  $sql="SELECT * FROM $table WHERE EMAIL_ID='$email'";
  $result=mysqli_query($conn,$sql);
  if(!$result)
  {
    echo "Query failed ".mysqli_error($conn);
    exit;
  }
  $user=mysqli_fetch_assoc($result);

  $password=$_POST["password"];
  $sql2="SELECT * FROM $table WHERE ENTER_PASSWORD='$password'";
  $result2=mysqli_query($conn,$sql2);
  if(!$result2)
  {
    echo "Query failed:".mysqli_error($conn);
  }
  $user2=mysqli_fetch_assoc($result2);

  if($user && $user2)
  {
    echo "your login is successfully completed";

    session_start();
    $_SESSION["last_name"]=$user["LAST_NAME"];
    $_SESSION["first_name"]=$user["FIRST_NAME"];
    $_SESSION["Mobile_number"]=$user["MOBILE_NUMBER"];
    $_SESSION["EMAIL_ID"]=$user["EMAIL_ID"];

    echo $_SESSION["Mobile_number"];

    if($table=="user_login")
    {
        $_SESSION['ts']="User";
       
        header("Location:User_frame_set.html");
        
    }
    else{
      $_SESSION['ts']="Admin";
        header("Location:Admin_frame_set.html");
    }
    
  }
  else{
   echo '<script>alert("invalid")</script>';

   echo '<script>
   window.location.href = "Login page.html";
   </script>';
   
  }
  mysqli_close($conn);

?>