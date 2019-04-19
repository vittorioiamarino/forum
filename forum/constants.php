<?php

	/* 
	 *
	 * DOCs
	 * Questo script contiene costanti utili al fine di evitare
	 * inutili ripetizioni di "hardcoded values"
	 *
	*/

	/* informazioni connessione database */
	$DB = [
		'server' => 'localhost',
		'username' => 'root',
		'password' => '',
		'name' => 'forum'
	];

	$EVTS = [
		'rc' => 'registration_completed',
		'tc' => 'thread_created',
		'cp' => 'comment_posted'
	];

?>