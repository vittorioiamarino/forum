<?php 
	session_start();
	require("database.php");

	//{"thread_id":"4","logged":true,"username":"iama","id_user":7
	if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
		$thread_id = (int)$_SESSION["thread_id"];
		$user_id = $_SESSION["id_user"];

		$stmt = $conn->prepare("INSERT INTO liket (Thread_id, Utente_id) VALUES (?, ?)");
		$stmt->bind_param("ii", $thread_id, $user_id);

		$stmt->execute();

		$stmt->close();
		$conn->close();

		echo "SUCCESS";

	} else {
		echo "ERROR"; 
	}

?>	