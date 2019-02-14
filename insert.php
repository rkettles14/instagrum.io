<html>
<head>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="script.js"></script>   
</head>
<body>

<?php

$host="localhost";
$db = "seng401";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);

    $id=$_POST['id'];
    $status=$_POST['status'];
    $queryStatement = "UPDATE photos SET liked=".$status." WHERE id=" . $id; 
    $stmt = $conn->prepare($queryStatement);
    $stmt->execute(); 
				


?>
</body>