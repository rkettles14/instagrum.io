<html>
<head>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="script.js"></script>   
</head>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Link: <br><input type="text" name="link" style="width:750px"> </br></br>
  Comment: <br><textarea type="text" name="comment" rows="4" cols="50"> </textarea></br></br>
  <input type="submit">
</form>


<?php

$host="localhost";
$db = "seng401";
$username = "root";
$password = "";
 
//$dsn = "mysql:host=$host;dbname=$db;$username;$password";

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // collect value of input field
    $link = $_REQUEST['link'];
    $comment = $_REQUEST['comment'];
    if (empty($link)) {
        echo "Link is empty";
    } else {
        try{
			// create a MySQL database connection
			$conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
		 
			// display a message if connected to the PostgreSQL successfully
			if($conn){
			//	echo "Connected to the <strong>$db</strong> database successfully!";
				$queryStatement = "INSERT INTO photos (link, comment, created, liked) VALUES ('$link', '$comment', '" . date("Y-m-d g:i:s") . "', 0)"; 
				//$query = $conn->query($queryStatement);
				//echo $queryStatement; 
				
				$stmt = $conn->prepare($queryStatement);
				$stmt->execute(); 

			}
		}catch (PDOException $e){
			// report error message
			echo $e->getMessage();
		}
    }
}



try{
	// create a PostgreSQL database connection
	$conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
 
	// display a message if connected to the PostgreSQL successfully
	if($conn){
		//echo "Connected to the <strong>$db</strong> database successfully!";
		$queryStatement = "SELECT * FROM photos ORDER BY id DESC"; 
		$query = $conn->query($queryStatement);
		
		
		
		//$results = Array(); 
		$results = $query->fetchAll();
		
		$output = "";
		
		foreach($results as $result)
		{
			// $liked = "";
			// if($result[4] == '1' ){
			// 	$liked = "You like this!";
			// }
			$id = $result[0];
			$output .= '<div id="' . $result[3] . '" style="margin:15px; width:500px; background-color:lightgray; padding:15px; display: inline-block;">';
			$output .= '<img src="'. $result[0] . '" width=400px; >';
			$output .= '<p>' . $result[1] . '</p>';
			$output .= '<p id="likestatus">' . "" . '</p>';
			$output .= '<br>';
			$output .= '<form id="update">
									<p id="id" style="display: none">'.$result[3].'</p>
									<input id="likebutton" type="submit" value="Like">
									</form></br>.';
			$output .= '<span style="font-size:9px; color:navy;">' . $result[2] . '</span>';
			$output .= '<hr>'; 
			$output .= '</div>'; 
			
		}
		
		echo $output; 
	}
}catch (PDOException $e){
	// report error message
	echo $e->getMessage();
}

?>

</body>
</html>