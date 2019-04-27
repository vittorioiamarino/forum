<?php
	include("head.php");
	include("customnav.php");
?>

<style type="text/css">body {background: #eee;}</style>

<div class="uk-container">
	<h2 class="font" style="color: rgb(102, 102, 102);">Domande popolari</h2>


	<?php 
		require("database.php");
		//$stmt = $conn->prepare("SELECT *, T.id as thread_id, T.data as thread_data FROM `thread` AS T INNER JOIN `utente` AS U ON T.Utente_id = U.id ORDER BY T.data DESC");
		$stmt = $conn->prepare("SELECT *, T.id as thread_id, T.data as thread_data, COUNT(*) AS n_risp FROM thread AS T INNER JOIN post AS P ON T.id = P.Thread_id INNER JOIN utente AS U ON T.Utente_id = U.id GROUP BY T.id ORDER BY n_risp DESC");

    $stmt->execute();
    $result = $stmt->get_result();

    $threads = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    $conn->close();

    foreach($threads as $thread) {
    	echo "<div class='uk-card uk-card-default uk-width-2-3@m uk-card-hover'>
                              <div class='uk-card-header'>
                                  <div class='uk-grid-small uk-flex-middle' uk-grid>
                                      <div class='uk-width-auto'>
                                          <div class='f-circle'></div>
                                      </div>
                                      <div class='uk-width-expand'>
                                          <h3 class='uk-card-title uk-margin-remove-bottom'>{$thread['titolo']}</h3>
                                          <p class='uk-text-meta uk-margin-remove-top'>
                                            {$thread['thread_data']} - <strong>{$thread['username']}</strong>
                                          </p>
                                      </div>
                                  </div>
                                  <div class='uk-card-badge uk-label'>
                                  	{$thread['n_risp']} Risposte
                                  </div>
                              </div>
                              <div class='uk-card-footer'>
                                  <a href='viewthread.php?thread_id={$thread['thread_id']}' class='uk-button uk-button-text'>VISUALIZZA THREAD</a>
                                  
                              </div>
                          </div><br/><br/>";
    }
	?>

</div>