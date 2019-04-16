<?php

  # Inizializzo la sessione per capire se l'utente è loggato o guest
  session_start();

?>

<nav class="uk-navbar-container uk-margin" uk-navbar>
  <div class="uk-navbar-left">

    <a class="uk-navbar-item uk-logo" href="#">
      <strong>FORUM</strong>
    </a>

    <div class="uk-navbar-item">
      <form action="javascript:void(0)">
        <input class="uk-input uk-form-width-large" type="text" placeholder="Search">
      </form>
    </div>

    <div class="uk-navbar-item">

      <!-- controllo presenza sessione di autenticazione:
           se l'utente è autenticato può procedere diretto alla creazione di un nuovo thread.
           Altrimenti dovrà autenticarsi oppure creare un nuovo profilo -->
      <?php if(isset($_SESSION['logged']) && $_SESSION['logged'] == true): ?>
        <button class="uk-button uk-button-default" uk-toggle="target: #modal-ask" id="ask-a-question-link">NUOVA DOMANDA</button>
      <?php else: ?>
        <button class="uk-button uk-button-default" uk-toggle="target: #modal-auth" id="ask-a-question-link">NUOVA DOMANDA</button>
      <?php endif; ?>

    </div>


    <!-- se l'utente è loggato mostro il suo username nella navbar -->
    <?php if(isset($_SESSION['logged']) && $_SESSION['logged'] == true && isset($_SESSION["username"])): ?>
      <div class="uk-navbar-item">
        <div>
          <?php echo $_SESSION["username"]; ?>
        </div>
      </div>
    <?php endif; ?>
    


  </div>
</nav>




<!-- Modal ask:
     modal per creare un nuovo thread.
     Mostrata solo in presenza di utente autenticato -->
<div id="modal-ask" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Fai una domanda</h2>
        </div>
        
        <!-- start auth form -->  
        <form class="uk-form-stacked" id="form-auth-ask">
          <div class="uk-margin">
              <label class="uk-form-label" for="form-stacked-text">Titolo della domanda</label>
              <div class="uk-form-controls">
                  <input class="uk-input" id="form-stacked-text" type="text" placeholder="Inserire testo" autocomplete="off">
              </div>
          </div>

          <div class="uk-margin">
              <label class="uk-form-label" for="form-stacked-text">Descrizion (opzionale)</label>
              <div class="uk-form-controls">
                  <input class="uk-input" id="form-stacked-text" type="password" placeholder="Inserire testo" autocomplete="off">
              </div>
          </div>

        <!-- end auth form -->
        </form>

        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">ANNULLA</button>
            <button class="uk-button uk-button-primary" type="button">CREA THREAD</button>
        </div>
    </div>
</div>


<!-- Modal auth:
     modal per effettuare accesso/login.
     Mostrata per autenticare l'utente -->
<div id="modal-auth" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Autenticazione richiesta</h2>
        </div>
        <div class="uk-modal-body">

        <!-- start auth form -->  
        <form class="uk-form-stacked" id="form-auth-login" action="login.php" method="POST">
          <div class="uk-margin">
              <label class="uk-form-label" for="form-stacked-text">Username</label>
              <div class="uk-form-controls">
                  <input class="uk-input" id="form-stacked-text" type="text" placeholder="Inserire testo" name="username" autocomplete="off">
              </div>
          </div>

          <div class="uk-margin">
              <label class="uk-form-label" for="form-stacked-text">Password</label>
              <div class="uk-form-controls">
                  <input class="uk-input" id="form-stacked-text" type="password" placeholder="Inserire testo" name="password" autocomplete="off">
              </div>
          </div>

          <div class="uk-margin">
            <span>Non hai un account: </span>
            <!--<button class="uk-button uk-button-link">Registrati</button>-->
            <a href="#modal-auth-reg" class="uk-button uk-button-link" uk-toggle>Registrati</a>
          </div>

        <!-- end auth form -->

          <div class="uk-margin">
            <button class="uk-button uk-button-primary" type="submit">LOGIN</button>
          </div>

        </form>
          
        </div>
        
        <!-- bottone footer con float right rimosso -->

    </div>
</div>


<!-- Modal aut reg:
     modal per creare un nuovo profilo.
     Mostrata solo in presenza di un utente guest -->
<div id="modal-auth-reg" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Registrazione profilo</h2>
        </div>
        <div class="uk-modal-body">

          <!-- start auth form -->  
          <form class="uk-form-stacked" id="form-auth-reg" action="register.php" method="POST">
            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">Username</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="form-stacked-text" type="text" placeholder="Inserire testo" autocomplete="off" name="username">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">Password</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="form-stacked-text" type="password" placeholder="Inserire testo" autocomplete="off" name="password">
                </div>
            </div>

            <div class="uk-margin">
              <span>Possiedi già un account: </span>
              <a href="#modal-auth" class="uk-button uk-button-link" uk-toggle>Login</a>
            </div>

            <div class="uk-margin">
              <button class="uk-button uk-button-primary" type="submit">REGISTRATI</button>
            </div>

          <!-- end auth form -->
          </form>
          
        </div>
        <!--<div class="uk-modal-footer uk-text-right">
          <button class="uk-button uk-button-primary" type="submit">REGISTRATI</button>
        </div>-->
    </div>
</div>