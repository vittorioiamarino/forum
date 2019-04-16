<?php 
	
	# inizializzo la sessione in caso di login effettivo
	session_start();


	# richiedo modulo database
	require("database.php");


	# ottengo i dati passati in POST dal form di registrazione
	$username = $_POST["username"];
	$password = $_POST["password"];


	/* 
	if ($stmt = $conn->prepare("SELECT * FROM Utente WHERE username=?")) {

	    $stmt->bind_param("s", $username);

	    
	    $stmt->execute();


	    # ottengo i dati della query
	    $result = $stmt->get_result();

	    
	    	contiene num_rows, field_count etc
	    var_dump($result); 

	    # ottengo il numero delle righe
	    $row_number = $stmt->num_rows;

	    var_dump($result);

	    # controllo l'andamento della query
	    if($row_number == 1) {
	    	echo '<h1> yes </h1>';

	    	# ottengo i dati sottoforma di array associativo
	    	$user = $result->fetch_assoc();

	    	var_dump($user);

	    } else {
	    	// redirect errore
	    	echo '<h1> no </h1>';
	    }   

	   
	    $stmt->close();
	}*/


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

	  # redirect all'index
	  header("Location: index.php");

	} else {

		# l'utente non ha inserito la password corretta
	  
	}

	$stmt->close();



	/*
	$password = 'LaM1aPassW0rd'; // password valida
	$hashedPassword = password_hash($password, PASSWORD_DEFAULT); // hash memorizzato nel database
	$userPassword = 'LaM1aPassW0rd'; // password inserita dall'utente nel login
	if (password_verify($userPassword, $hashedPassword)) {
	    echo "Accesso effettuato con successo";
	} else {
	    echo "La password inserita non è corretta";
	}
	*/


	//https://websitebeaver.com/prepared-statements-in-php-mysqli-to-prevent-sql-injection

?>