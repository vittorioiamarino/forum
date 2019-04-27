<?php

  # Inizializzo la sessione per capire se l'utente è loggato o guest
  session_start();

?>

<style type="text/css">

  html, body {
    min-height: 100%;
  }
  body {position: relative;}

  #results {
   position: absolute;
   top: 50px;
   width: 94%;
   /*max-width:870px;*/
   overflow-y: auto;
   max-height: 400px;
   box-sizing: border-box;
   z-index: 1001;
   background: rgb(248, 248, 248);
   border: 1px solid #eee;
   border-radius: 3px;
   padding: 20px;
  }
  #results li {
    border-bottom: 1px solid #ddd;
    margin: 20px 5px 20px 5px;
  }
  #results li:first-child {
    margin-top: 5px;
  }
  #results li:last-child {
    margin-bottom: 5px;
  }
  #results li a {
    color: rgb(112, 112, 112);
    font-size: 25px;
  }
  li {
    list-style: none;
  }
  .invisible { visibility: hidden; }
  .visible { visibility: visible; }
  .span_res {
    color: gray;
    font-style: italic;
    font-size: 12px;
    float: right;
  }
  .overlay {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background-color: rgba(0,0,0,0.5);
    z-index: 10;
  }
</style>

<div uk-sticky>
<nav class="uk-navbar-container uk-margin" uk-navbar style="opacity: 1;">
  <div class="uk-navbar-left">

    <a class="uk-navbar-item uk-logo font" href="#">
      <strong>FORUM</strong>
    </a>
  </div>

  <div class="uk-navbar-center">
    <div class="uk-navbar-item" style="position: relative; opacity: 1;">
      <!--<form action="javascript:void(0)">
        <input class="uk-input uk-form-width-large" type="text" placeholder="Search">
      </form>-->
      <form class="uk-search uk-search-default" style="background-color: white; width: 500px;">
        <span uk-search-icon></span>
        <input class="uk-search-input" id="search" type="search" placeholder="Search..." style="border-color: silver;" autocomplete="off">
      </form>
      <ul id="results"></ul>
    </div>
  </div>

    
    <div class="uk-navbar-right">
      <div class="uk-navbar-item">

        <!-- controllo presenza sessione di autenticazione:
             se l'utente è autenticato può procedere diretto alla creazione di un nuovo thread.
             Altrimenti dovrà autenticarsi oppure creare un nuovo profilo -->
        <?php if(isset($_SESSION['logged']) && $_SESSION['logged'] == true): ?>
          <button class="uk-button uk-button-default" uk-toggle="target: #modal-ask" id="ask-a-question-link">NUOVA DOMANDA</button>
        <?php else: ?>
          <button class="uk-button uk-button-default" uk-toggle="target: #modal-auth" id="ask-a-question-link">NUOVA DOMANDA</button>
        <?php endif; ?>


        <!-- se l'utente è loggato mostro il suo username nella navbar -->
        <?php if(isset($_SESSION['logged']) && $_SESSION['logged'] == true && isset($_SESSION["username"])): ?>
          <div class="uk-navbar-item font2">
            <div>
              <?php echo $_SESSION["username"]; ?>
            </div>
          </div>
        <?php endif; ?>

      </div>
    </div>


    
    


  </div>
</nav>
</div>



<!-- Modal ask:
     modal per creare un nuovo thread.
     Mostrata solo in presenza di utente autenticato -->
<!--<div id="modal-ask" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Fai una domanda</h2>
        </div>
        
       
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

        
        </form>

        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">ANNULLA</button>
            <button class="uk-button uk-button-primary" type="button">CREA THREAD</button>
        </div>
    </div>
</div>-->
<div id="modal-ask" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title font">Posta una domanda</h2>
        </div>
        <div class="uk-modal-body">

        <!-- start auth form -->  
        <form class="uk-form-stacked" id="form-auth-ask" action="thread.php" method="POST">
          <div class="uk-margin">
              <label class="uk-form-label font2" for="form-stacked-text">Titolo</label>
              <div class="uk-form-controls">
                  <input class="uk-input" id="form-stacked-text" type="text" placeholder="Inserire testo" name="title" autocomplete="off">
              </div>
          </div>

          <div class="uk-margin">
              <label class="uk-form-label font2" for="form-stacked-text">Descrizione (opzionale)</label>
              <div class="uk-form-controls">
                  <input class="uk-input" id="form-stacked-text" type="text" placeholder="Inserire testo" name="description" autocomplete="off">
              </div>
          </div>


        <!-- end auth form -->

          <div class="uk-margin">
            <button class="uk-button uk-button-default uk-modal-close" type="button">ANNULLA</button>
            <button class="uk-button uk-button-primary" type="submit">CREA THREAD</button>
          </div>

        </form>
          
        </div>
        
        <!-- bottone footer con float right rimosso -->

    </div>
</div>

<!-- Modal auth:
     modal per effettuare accesso/login.
     Mostrata per autenticare l'utente -->
<div id="modal-auth" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title font">Autenticazione richiesta</h2>
        </div>
        <div class="uk-modal-body">

        <!-- start auth form -->  
        <form class="uk-form-stacked" id="form-auth-login" action="login.php" method="POST">
          <div class="uk-margin">
              <label class="uk-form-label font2" for="form-stacked-text">Username</label>
              <div class="uk-form-controls">
                  <input class="uk-input" id="form-stacked-text" type="text" placeholder="Inserire testo" name="username" autocomplete="off">
              </div>
          </div>

          <div class="uk-margin">
              <label class="uk-form-label font2" for="form-stacked-text">Password</label>
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
            <h2 class="uk-modal-title font">Registrazione profilo</h2>
        </div>
        <div class="uk-modal-body">

          <!-- start auth form -->  
          <form class="uk-form-stacked" id="form-auth-reg" action="register.php" method="POST">
            <div class="uk-margin">
                <label class="uk-form-label font2" for="form-stacked-text">Username</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="form-stacked-text" type="text" placeholder="Inserire testo" autocomplete="off" name="username">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label font2" for="form-stacked-text">Password</label>
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