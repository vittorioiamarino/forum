<?php 
	
	# inizializzo la sessione in caso di login effettivo
	session_start();


	# richiedo modulo database
	require("database.php");


	# ottengo i dati passati in POST dal form di registrazione
	$username = $_POST["username"];
	$password = $_POST["password"];


	$stmt = $conn->prepare("SELECT * FROM utente WHERE username = ?");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows === 0) exit('No rows');
	$user = $result->fetch_assoc();
	

	# controllo della password
	if (password_verify($password, $user["password"])) {

		# l'utente ha inserito la password corretta
		$_SESSION["logged"] = true;
	  $_SESSION["username"] = $user["username"];
	  $_SESSION["id_user"] = $user["id"];

	  # redirect all'index
	  header("Location: index.php");

	} else {

		# l'utente non ha inserito la password corretta
	  
	}

	$stmt->close();

?>