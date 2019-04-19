<?php 

	session_start();

	// Delete certain session
	$_SESSION["logged"] = false;

  unset($_SESSION['username']);
  unset($_SESSION['id_user']);
  // Delete all session variables
  // session_destroy();

  header("Location: index.php");

?>