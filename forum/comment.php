<?php 

	session_start();
	require("database.php");


	$thread_id = $_SESSION["thread_id"];
	$user_id = $_SESSION["id_user"];
	$answer = $_POST["answer"];

	# setup query sicura con prepared statement
	$stmt = $conn->prepare("INSERT INTO post (contenuto, Utente_id, Thread_id) VALUES (?, ?, ?)");
	$stmt->bind_param("sii", $answer, $user_id, $thread_id);


	# esecuzione statement
	$stmt->execute();


	# chiusura statement e connessione
	$stmt->close();
	$conn->close();

	# re-indirizzamento dopo la conclusione della registrazione
	$success_url = "index.php?{$EVTS['cp']}";
	header("Location: $success_url");
?>