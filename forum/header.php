<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <link rel="stylesheet" href="csslib/css/uikit.min.css">
  <script src="csslib/js/uikit.min.js"></script>
  <script src="csslib/js/uikit-icons.min.js"></script>

  <style type="text/css">
    .f-circle {
      width: 40px;
      height: 40px;
      background: orange;
      border-radius: 5px;
    }
    .font {
      font-family: "Gilroy ExtraBold";
    }
    .font2 {
      font-family: "Gilroy";
    }
  </style>

</head>
<body>
  
  <!-- start page container -->
  <div class="uk-container">


    <!-- includo componente navbar -->
    <?php include("navbar.php"); ?>


    <?php

      # richiedo modulo costanti per verificare eventuale registrazione
      require("constants.php");

      # estraggo il codice 
      $reg_comp_check = $EVTS['rc'];

      # mostro alert di successo in caso di registrazione appena completata
      if(isset($_GET[$reg_comp_check])): ?>
        <div class="uk-alert-success" uk-alert>
          <a class="uk-alert-close" uk-close></a>
          <h3>Registrazione completata!</h3>
          <p>Congratulazioni! Hai completato la tua registrazione con successo. Prova ad effettuare un accesso.</p>
        </div>
      <?php endif; ?>

      <?php
        # se viene creato un nuovo thread mostro l'alert
        $reg_comp_check = $EVTS['tc'];
        if(isset($_GET[$reg_comp_check])): ?>
        <div class="uk-alert-primary" uk-alert>
          <a class="uk-alert-close" uk-close></a>
          <h3>Thread creato!</h3>
          <p>Congratulazioni! Il tuo thread è stato creato con la tua domanda!</p>
        </div>
      <?php endif; ?>

      <?php
        # se viene postato un nuovo commento mostro l'alert
        $reg_comp_check = $EVTS['cp'];
        if(isset($_GET[$reg_comp_check])): ?>
        <div class="uk-alert-primary" uk-alert>
          <a class="uk-alert-close" uk-close></a>
          <h3>Commento postato!</h3>
          <p>Congratulazioni! la tua risposta è stata postata sul thread!</p>
        </div>
      <?php endif; ?>



    <!-- Start grid container -->
    <div class="uk-child-width-expand@s" uk-grid>
      
      <div class="uk-width-1-6">
        <!--<div class="uk-card uk-card-default uk-card-body">
        <ul class="uk-list uk-link-text">
          <li><span class="uk-margin-small-right" uk-icon="home"></span><a href="#">Home</a></li>
          <li><span class="uk-margin-small-right" uk-icon="star"></span><a href="#">Popular</a></li>
          <li><span class="uk-margin-small-right" uk-icon="user"></span><a href="profile.php">Profilo</a></li>
        </ul>
        </div>-->
        <ul class="uk-list uk-list-divider uk-link-text font2">
          <li><span class="uk-margin-small-right" uk-icon="home"></span><a href="#">Home</a></li>
          <li><span class="uk-margin-small-right" uk-icon="star"></span><a href="#">Popular</a></li>
          <li><span class="uk-margin-small-right" uk-icon="user"></span><a href="profile.php">Profilo</a></li>
        </ul>
      </div>

      <div class="uk-width-5-6" style="background: #FAFAFA;">
        <!--<div class="uk-card uk-card-default uk-card-body">Item</div>-->

        <h1 class="uk-heading-divider font" style="color: #707070;">Il mio Feed</h1>

        <?php

          require("database.php");
          
          //$stmt = $conn->prepare("SELECT * FROM `thread` ORDER BY data DESC");
          //$stmt = $conn->prepare("SELECT * FROM `thread` AS T INNER JOIN `utente` AS U ON T.Utente_id = U.id ORDER BY T.data DESC");
          //$stmt = $conn->prepare("SELECT *, T.id as thread_id FROM `thread` AS T INNER JOIN `utente` AS U ON T.Utente_id = U.id ORDER BY T.data DESC");
          $stmt = $conn->prepare("SELECT *, T.id as thread_id, T.data as thread_data FROM `thread` AS T INNER JOIN `utente` AS U ON T.Utente_id = U.id ORDER BY T.data DESC");
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows === 0) exit('No rows');
          

          if($result->num_rows == 0) {
            echo 'Nessun thread disponibile';
          } else {
            $threads = $result->fetch_all(MYSQLI_ASSOC);

            foreach($threads as $thread) {
              /*foreach ($thread as $key => $value) {
                  echo "$key: $value";
              }
              echo "Titolo: <strong>{$thread['titolo']}</strong><br/>";
              echo "Descrizione: <strong>{$thread['descrizione']}</strong><br/>";
              //echo "Autore: <strong>{$_SESSION['username']}</strong><br/>";
              echo "Data pubblicazione: <strong>{$thread['data']}</strong><br/>";
              echo "<hr class='uk-divider-icon'>";*/

              # ottengo il numero di like
              $stmt = $conn->prepare("SELECT COUNT(*) AS n_likes FROM (SELECT * FROM liket WHERE Thread_id = ?) AS num_likes");
              $stmt->bind_param("i", $thread['thread_id']);
              $stmt->execute();
              $result = $stmt->get_result();
              $num_likes = $result->fetch_assoc();
              $number_of_likes = $num_likes["n_likes"];

              # ottengo il numero di commenti
              $stmt = $conn->prepare("SELECT COUNT(*) AS n_comments FROM (SELECT * FROM post WHERE Thread_id = ?) AS num_comments");
              $stmt->bind_param("i", $thread['thread_id']);
              $stmt->execute();
              $result = $stmt->get_result();
              $num_comments = $result->fetch_assoc();
              $number_of_comments = $num_comments["n_comments"];

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
                              </div>
                              <div class='uk-card-body'>
                                  <p>{$thread['descrizione']}</p>
                              </div>
                              <div class='uk-card-footer'>
                                  <a href='viewthread.php?thread_id={$thread['thread_id']}' class='uk-button uk-button-text'>VISUALIZZA THREAD</a>
                                  <div class='uk-align-right'>  
                                  &nbsp;&nbsp;<span id='number_of_likes'> $number_of_comments </span>
                                  <span style='color: orange;' uk-icon='comments'></span>
                                  &nbsp;&nbsp; 
                                  <span id='number_of_likes'> $number_of_likes </span>
                                  <span style='color: orange;' uk-icon='heart'></span>
                                </div>
                              </div>
                          </div><br/><br/>";


            }
          }

          $stmt->close();
          $conn->close();
        ?>

      </div>

    <!-- end grid container -->
    </div>



  <!-- End page container -->
  </div>