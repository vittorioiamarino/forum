<?php 
	
	require("database.php");

	$username = $_POST["username"];
	$password = $_POST["password"];

	
	$stmt = $conn->prepare("SELECT * FROM utente AS U WHERE U.username = ?");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();

	if($result->num_rows == 0) {
		// tipo di errore: USER does NOT EXIST
		$output = ["error" => "UNE"];
		echo json_encode($output);
	} else {
		
		$user = $result->fetch_assoc();

		if (password_verify($password, $user["password"])) {
		  $output = ["success" => true];
			echo json_encode($output);
		} else {
			// tipo di errore: WRONG PASSWORD
			$output = ["error" => "WP"];
			echo json_encode($output);
		}

	}

?>