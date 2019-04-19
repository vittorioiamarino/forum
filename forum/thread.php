<?php
	//https://websitebeaver.com/prepared-statements-in-php-mysqli-to-prevent-sql-injection
	
	session_start();
	require("database.php");
	
	$title = $_POST["title"];
	$description = $_POST["description"];

	$user_id = $_SESSION["id_user"];


	$stmt = $conn->prepare("INSERT INTO Thread (titolo, descrizione, Utente_id) VALUES (?, ?, ?)");
	$stmt->bind_param("ssi", $title, $description, $user_id);
	$stmt->execute();
	$stmt->close();
	$conn->close();

	$success_url = "index.php?{$EVTS['tc']}";
	header("Location: $success_url");


?>