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




/* form REGISTRAZIONE handler per AJAX
	TODO: informazioni registrazione real time come instagram
auth_reg_form.addEventListener("input", function(event) {
	
}); */


/* form AUTENTICAZIONE procedura
auth_login_form.addEventListener("submit", function(event) {
	event.preventDefault();
}); */


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
	
	CHIEDERE COME FANNO IL DESIGN
	CHIEDERE COME SIA POSSIBILE CHE LA GENTE VADA DALLE AZIENDE NEL 2019 PER UN SITO
	CHIEDERE COSA USANO PER DOMINIO E HOSTING
	CHIEDERE PROCEDURA STANDARD (PLUGINS ETC) PER LA PRODUZIONE DEI SITI
*/