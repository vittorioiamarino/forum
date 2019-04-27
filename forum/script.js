/* 
  *
  * VITTORIO IAMARINO - PROGETTO 'FORUM' (APRILE 2019)
	* DOCs
	* Questo script si occupa del front-end di tutto il sito
	*
*/



/* bottone 'ASK A QUESTION' della navbar */
const ask_a_question_button = document.getElementById("ask-a-question-link");

/* form AUTENTICAZIONE */
const auth_login_form = document.getElementById("form-auth-login");

/* form REGISTRAZIONE */
const auth_reg_form = document.getElementById("form-auth-reg");

/* form CREAZIONE THREAD */
const new_thread_form = document.getElementById("form-auth-ask");


const like_button = document.getElementById("thread_like_button");

/* spam che mostra il numero di like di un thread.
	 tengo il riferimento perchè deve essere manipolata dalle richieste AJAX */
const likes_span = document.getElementById("number_of_likes");


/* form REGISTRAZIONE handler per AJAX
	TODO: informazioni registrazione real time come instagram
auth_reg_form.addEventListener("input", function(event) {
	
}); */


/* form AUTENTICAZIONE procedura
auth_login_form.addEventListener("submit", function(event) {
	event.preventDefault();
}); */


$(document).ready(() => {

		var click_elem;

		$(document).mousedown(function(e) {
        click_elem = $(e.target);
    });
    $(document).mouseup(function(e) {
        click_elem = null;
    });



		$("#thread_like_button").click(function (event) {
		  $.ajax({
		    type: "POST",
		    url: "like.php",
		    data: "someData=someThing&someMore=somethingElse"
		  })
		  .done((e) => {
		  	let likes = parseInt(likes_span.textContent);
		  	likes++;
		  	likes_span.textContent = likes;
		  })
		  .fail(() => console.log("ERRORE"));

			 event.preventDefault();
		});



		$("#search").keyup(function(){
			$('#result').html('');
			var searchField = $('#search').val();
			var expression = new RegExp(searchField, "i");


			if(searchField.length == 0) {
				//$("#results").hide();
				$("#results").empty();
				$("#results").addClass("invisible");
				$("#results").removeClass("visible");
				return;
			} else {
				$("#results").empty();
				$.ajax({
			    type: "POST",
			    url: "search.php",
			    data: "data=" + searchField,
			  })
			  .done((e) => {
			  	let results = JSON.parse(e);
				  if(results.length == 0) {
				  	$("#results").append("<li class='font' style='font-size: 20px;'>Nessun risultato &nbsp;<span class='uk-margin-small-right' uk-icon='icon: warning;'></span></li>");
				  }
				  else {
				  	for(let result of results) { //viewthread.php?thread_id=
				  		let url_string = "'viewthread.php?thread_id='"+result.thread_id+"''";

				  		//$("#results").append("<li><a href='viewthread.php?thread_id="+result.thread_id+"' class='font'>"+result.titolo+"</a><br/><span>"+result.username+"</span><span class='span_res'>"+result.thread_data+"</span></li>");
				  		$("#results").append("<li><a href='viewthread.php?thread_id="+result.thread_id+"' class='font'>"+result.titolo+"</a><br/><span>"+result.username+"</span><span class='span_res'>"+result.thread_data+"</span></li>");
				  		//$("#results").append("<p><a href='https://www.google.com'>Google</a></p>");
				  	}
				  }

			  	$("#results").addClass("visible");
					$("#results").removeClass("invisible");
			  	
			  })
			  .fail(() => console.log("ERRORE"));
			 }

		  /*$("#search").blur(function() {
				$("#results").hide();
				$("#results").empty();
				$("#results").addClass("invisible");
				$("#results").removeClass("visible");
			});

			$("#search").focus(function() {
				$("#results").show();
				//$("#results").addClass("visible");
				$("#results").removeClass("invisible");
			});*/

		});

		$("#search").blur(function() {
			if(click_elem.closest().prevObject[0].nodeName == "A") {
				return;
			} else {

			$("#results").addClass("invisible");
			$("#results").removeClass("visible");
			$("#overlay_div").removeClass("overlay");
			$("#results").hide();
			$("#results").empty();
			document.getElementById("search").value = '';
			}
		});
		$("#search").focus(function() {
				$("#results").show();
				$("#results").addClass("visible");
				$("#results").removeClass("invisible");
				$("#overlay_div").addClass("overlay");
		});

		$("#results").addClass("invisible");
		$("#results").removeClass("visible");

});



/*
	IMPLEMENTARE LIKE SULLA HOME CON AJAX
	IMPLEMENTARE VISUALIZZAZIONE A PAGINA SEPARATA AL CLICK DELLA DOMANDA
	IMPLEMENTARE RISPOSTA DOMANDA
	FARE IL JOIN NELLA QUERY E DIRE MOSTRARE L'AUTORE
	SULLA HOME, NEI POST: QUANDO CLICCO SULL'AUTORE DEVE PORTARMI AL SUO PROFILO
	SULLA HOME, NEI POST: METTERE QUANTE RISPOSTE E QUANTI LIKE

	OPZ: AJAX LIKE BUTTON SU HOME>POST
	SE SONO LOGGATO I MIEI POST DEVONO DIRE 'IO/ME' INVECE DEL MIO USERNAME ESPLICITO

	SU VIEW THREAD: LINKARE PROFILO

	********************************************************************


	https://www.webslesson.info/2017/02/live-search-json-data-using-ajax-jquery.html
*/