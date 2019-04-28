<?php
	
	session_start();

	include("head.php");
	include("customnav.php");
	require("database.php");

	$thread_id = $_GET["thread_id"];
	$_SESSION["thread_id"] = $thread_id;

	//$stmt = $conn->prepare("SELECT * FROM Thread WHERE id = ?");
	$stmt = $conn->prepare("SELECT *, T.data as data_thread FROM `thread` AS T INNER JOIN `utente` AS U ON T.Utente_id = U.id WHERE T.id = ? ORDER BY T.data DESC");
	$stmt->bind_param("i", $thread_id);
	$stmt->execute();
	$result = $stmt->get_result();
	
	if($result->num_rows === 0) exit('Errore');

	$thread = $result->fetch_assoc();

	$stmt->close();
	$conn->close();


	# ottengo il numero di like a questo thread
	require("database.php");
	$stmt = $conn->prepare("SELECT COUNT(*) AS n_likes FROM (SELECT * FROM liket WHERE Thread_id = ?) AS num_likes");
	$stmt->bind_param("i", $thread_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$num_likes = $result->fetch_assoc();
	$number_of_likes = $num_likes["n_likes"];


	require("database.php"); // se tolgo questo require muore la connessione e non funzione più nulla
	#seconda query
	$stmt = $conn->prepare("SELECT *, P.data as data_post FROM post AS P INNER JOIN thread AS T ON P.Thread_id = T.id INNER JOIN utente AS U ON P.Utente_id = U.id WHERE T.id = $thread_id ORDER BY P.data DESC");
  $stmt->execute();
  $result = $stmt->get_result();

  $posts = $result->fetch_all(MYSQLI_ASSOC);

?>

<style type="text/css">
	body {
		background: #eee;
	}
</style>

<div class="uk-container">
	
	 <!-- Card thread -->
	<div class='uk-card uk-card-default uk-width-3-3@m uk-margin-medium-top'>
    <div class='uk-card-header'>
      <div class='uk-grid-small uk-flex-middle' uk-grid>
        <div class='uk-width-auto'>
          <div class='f-circle'></div>
        </div>
        <div class='uk-width-expand'>
          <h3 class='uk-card-title uk-margin-remove-bottom'>
            <?php echo $thread['titolo']; ?>
          </h3>
          <p class='uk-text-meta uk-margin-remove-top'>
            <?php echo $thread['data']; ?> -
            Domanda postata da <strong><?php echo $thread['username']; ?></strong>
          </p>
        </div>
      </div>
    </div>
    <div class='uk-card-body'>
      <p>
        <?php echo $thread['descrizione']; ?>
      </p>
    </div>
    <div class='uk-card-footer'>
			
			<a href="index.php" style="color: orange;" id="thread_like_button" class="uk-icon-button" uk-icon="heart"></a>
			
			<div class="uk-align-right">	
				<?php echo count($posts); ?> <span style="color: orange;" uk-icon="comments"></span>
				&nbsp;&nbsp; 
				<span id="number_of_likes">
					<?php echo $number_of_likes; ?>
				</span>
				<span style="color: orange;" uk-icon="heart"></span>
    	</div>
    </div>
  </div>

    
  <!-- Card risposta utente -->
  <div class="uk-child-width-2-2@s uk-margin-top" uk-grid>
	    <div>
	        <div class="uk-card uk-card-default uk-card-small uk-card-body">
	            
	            <!--<div class='uk-card-header'>
					      <div class='uk-grid-small uk-flex-middle' uk-grid>
					        <div class='uk-width-auto'>
					          <div class='f-circle'></div>
					        </div>
					        <div class='uk-width-expand'>
					          <h3 class='uk-card-title uk-margin-remove-bottom'>
					            vittorio iamarino
					          </h3>
					          <p class='uk-text-meta uk-margin-remove-top'>
					            Adesso
					          </p>
					        </div>
					      </div>
					    </div>-->

					    <!-- Form di commento -->
					    <form method="POST" id="form-comment" action="comment.php">
					    	<div class="uk-margin">
					    		<?php if($_SESSION["logged"] == false): ?>
				          	<textarea class="uk-textarea" rows="2" placeholder="Devi essere autenticato per partecipare alla discussione" disabled></textarea>
				          	<div class="uk-text-right uk-margin">
						        	<button class="uk-button uk-button-default" type="submit" disabled="">INVIA RISPOSTA</button>
						        </div>
				          <?php endif; ?>
				          <?php if($_SESSION["logged"] == true): ?>
				          	<textarea class="uk-textarea" id="form-comment-answer" rows="2" placeholder="Scrivi qui la tua risposta.." name="answer"></textarea>
				          	<div class="uk-text-right uk-margin">
						        	<button class="uk-button uk-button-default" type="submit">INVIA RISPOSTA</button>
						        </div>
				          <?php endif; ?>
				        </div>

				        
					    </form>
	            

	        </div>
	    </div>
	</div>



	<hr class="uk-divider-icon uk-margin-large-top">
	
	<div>
		<p style="font-size: 20px;">
			<span class="font">
				<?php echo count($posts); ?>
			</span>
			<span class="font2">RISPOSTE</span>
		</p>
	</div>


	<?php 
		if(count($posts) == 0) {
			echo "<div class='uk-card-header' style='background: #fafafa;'>
								      <div class='uk-grid-small uk-flex-middle' uk-grid>
								        Nessuna risposta a questa domanda
								      </div>
								    </div><hr class='uk-divider'>";
		} 
	?>


	<?php 
		if(count($posts) != 0) {
			foreach($posts as $post) {
				echo "<div class='uk-card-header' style='background: #fafafa;'>
								      <div class='uk-grid-small uk-flex-middle' uk-grid>
								        <div class='uk-width-auto'>
								          <div class='f-circle'></div>
								        </div>
								        <div class='uk-width-expand'>
								          <h3 class='uk-card-title uk-margin-remove-bottom'>
								            {$post['username']}
								          </h3>
								          <p class='uk-text-meta uk-margin-remove-top'>
								            {$post['data_post']}
								          </p>
								        </div>
								      </div>
								      <div class='uk-margin-medium-top uk-margin-small-bottom'>
								      	{$post['contenuto']}
								      </div>
								    </div><hr class='uk-divider'>";
			}
		}
	?>


<div class="uk-margin-large-bottom"></div>
<!-- fine container -->
</div>

<?php include("footer.php"); ?>

<script type="text/javascript">
	const new_comment_form = document.getElementById("form-comment");

	new_comment_form.addEventListener("submit", function(event) {
			let username = document.getElementById("form-comment-answer");

			if(username.value == '') {
				console.log("VALIDAZIONE FORM");
				event.preventDefault();
			}
			console.log("a");
			if(username.value == '') { $("#form-comment-answer").addClass("uk-form-danger"); }
		});
		$("#form-comment-answer").focus(function(){ $(this).removeClass("uk-form-danger"); });
		$("#form-comment-answer").blur(function(){
			if($(this).val().length == 0)
				$(this).addClass("uk-form-danger");
			else
				$(this).removeClass("uk-form-danger");
		});
</script>