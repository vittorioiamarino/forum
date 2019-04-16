<?php
	
	# inizializzo la sessione
	session_start();

	include("head.php");

?>


<div class="uk-container">
	<h1>
		<?php 
			if(isset($_SESSION["logged"]) && $_SESSION["logged"] == true) {
				echo "{$_SESSION['username']}";
			} else {
				echo "Utente Guest";
			} 
		?>
	</h1>


	<a class="uk-button uk-button-default" href="logout.php">LOGOUT</a>

</div>