<?php

	/* 
	 *
	 * VITTORIO IAMARINO - PROGETTO 'FORUM' (APRILE 2019)
	 * DOCs
	 * Questo script si occupa della connessione al database
	 *
	*/


	# richiedo informazioni connessione
	require("constants.php"); 


	# connessione database
	$conn = new mysqli(
		$DB['server'],
		$DB['username'],
		$DB['password'],
		$DB['name']
	);


	# controllo connessione database
	if($conn->connect_error)
		die("Errore connessione..");

?>