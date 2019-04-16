<?php 

	session_start();

	// Delete certain session
	$_SESSION["logged"] = false;

  unset($_SESSION['username']);
  // Delete all session variables
  // session_destroy();

  header("Location: index.php");

?>