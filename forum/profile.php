<?php
	
	# inizializzo la sessione
	session_start();

	include("head.php");
	include("customnav.php");

?>



<div class="uk-container uk-margin-large-bottom">
	
	<?php 
		if(isset($_SESSION["logged"]) && $_SESSION["logged"] == true) {
			echo "<h1 class='font'>{$_SESSION['username']}</h1>";
			echo "<a class='uk-button uk-button-default' href='logout.php'>LOGOUT</a>";
		} else {
			echo "<p style='font-size: 30px;' class='font2'>Utente <strong class='font'>GUEST</strong></p>";
		}
	?>
	


	
	

	<hr class="uk-divider-icon uk-margin-medium-top">

	<h3 class="font2">Le mie domande</h3>

	<?php

		require("database.php");
		
		
		if(!isset($_SESSION["id_user"])) {
			echo "<div class='uk-card-header' style='background: #fafafa;'>
								      <div class='uk-grid-small uk-flex-middle' uk-grid>
								        Devi essere autenticato per domandare
								      </div>
								    </div>";
			exit();
		}
		$user_id = $_SESSION["id_user"];

		$stmt = $conn->prepare("SELECT * FROM Thread WHERE Utente_id = ? ORDER BY Thread.data DESC");
		$stmt->bind_param("i", $user_id);
		$stmt->execute();
		$result = $stmt->get_result();
		//if($result->num_rows === 0) exit('No rows');
		

		if($result->num_rows == 0) {
			echo 'Non hai ancora fatto nessuna domanda';
		} else {
			$threads = $result->fetch_all(MYSQLI_ASSOC);

			echo "<ul class='uk-list uk-list-divider'>";

			foreach($threads as $thread) {
				/*foreach ($thread as $key => $value) {
						echo "$key: $value";
				}*/
				echo "<li>";
				//echo "<strong>{$thread['titolo']}</strong> - ";
				//echo "{$thread['data']}<br/>";
				//echo "{$thread['descrizione']}<br/>";
				//echo "Autore: <strong>{$_SESSION['username']}</strong><br/>";
				echo "<div class='uk-width-expand uk-margin-small-top uk-margin-small-left'>
				        <h3 class='uk-card-title uk-margin-remove-bottom'>{$thread['titolo']}</h3>
				        <p class='uk-text-meta uk-margin-remove-top'>
				          {$thread['data']}
				        </p>
						        {$thread['descrizione']}

				      </div>";
				echo "</li>";
			}

			echo "</ul>";
		}

		$stmt->close();
		$conn->close();
	?>

</div>