<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <link rel="stylesheet" href="csslib/css/uikit.min.css">
  <script src="csslib/js/uikit.min.js"></script>

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



    <!-- Start grid container -->
    <div class="uk-child-width-expand@s uk-text-center" uk-grid>
      
      <div class="uk-width-1-6">
        <div class="uk-card uk-card-default uk-card-body">
        <ul class="uk-list uk-link-text">
          <li><a href="#">Home</a></li>
          <li><a href="#">Popular</a></li>
          <li><a href="#">Profile</a></li>
        </ul>
        </div>
      </div>

      <div class="uk-width-5-6">
        <div class="uk-card uk-card-default uk-card-body">Item</div>
      </div>

    <!-- end grid container -->
    </div>



  <!-- End page container -->
  </div>