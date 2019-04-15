<?php
	
	/* 
  *
  * VITTORIO IAMARINO - PROGETTO 'FORUM' (APRILE 2019)
	* DOCs
	* Questo script si occupa della registrazione dell'utente:
	* vengono prelevati i dati (username, password) dal form via POST. 
	*
*/


	# richiedo modulo connessione database
	require("database.php");


	# richiedo modulo costanti
	require("constants.php");


	# ottengo i dati passati in POST dal form di registrazione
	$username = $_POST["username"];
	$password = $_POST["password"];


	# hash password per maggiore sicurezza
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);


	# query registrazione utente
	$sql = "INSERT INTO Utente ('username', 'password') VALUES ('$username', '$password')";


	# setup query sicura con prepared statement
	$stmt = $conn->prepare("INSERT INTO Utente (username, password) VALUES (?, ?)");
	$stmt->bind_param("ss", $username, $hashed_password);


	# esecuzione statement
	$stmt->execute();


	# chiusura statement e connessione
	$stmt->close();
	$conn->close();


	# re-indirizzamento dopo la conclusione della registrazione
	$success_url = "index.php?{$EVTS['rc']}";
	header("Location: $success_url");

?>