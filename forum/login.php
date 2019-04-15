<?php 

	require("database.php");


	# ottengo i dati passati in POST dal form di registrazione
	$username = $_POST["username"];
	$password = $_POST["password"];


	/* create a prepared statement */
	if ($stmt = $mysqli->prepare("SELECT * FROM Utente WHERE username=? AND password=?")) {

	    /* bind parameters for markers */
	    $stmt->bind_param("ss", $city);

	    /* execute query */
	    $stmt->execute();

	    /* bind result variables */
	    $stmt->bind_result($district);

	    /* fetch value */
	    $stmt->fetch();

	    printf("%s is in district %s\n", $city, $district);

	    /* close statement */
	    $stmt->close();
	}

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

?>