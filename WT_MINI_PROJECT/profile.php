<?php
session_start();
$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];
$Mobile_number = $_SESSION["Mobile_number"];
$EMAIL_ID = $_SESSION["email"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['ts'] ?>Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        h1 {
            margin: 0;
            font-size: 24px;
        }
        .profile-info {
            padding: 20px;
        }
        .profile-info h2 {
            /* margin-top: 0; */
            font-size: 20px;
            color: #555;
        }
        .profile-info p {
            /* margin: 5px 0; */
            color: #777;
        }
        .button-container {
            text-align: center;
            padding-bottom: 20px;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Profile</h1>
        </div>
        <div class="profile-info">
            <h2>Name:</h2>
            <p><?php echo $first_name . " " . $last_name; ?></p>
            <h2>Mobile Number:</h2>
            <p><?php echo $Mobile_number; ?></p>
            <h2>Email:</h2>
            <p><?php echo $EMAIL_ID; ?></p>
        </div>
        
    </div>
</body>
</html>
