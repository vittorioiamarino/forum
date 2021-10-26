# Forum

### Project description
This is a personal project, a very simple reddit-like forum.\
It allows users to sign up and ask questions that can be answered from other users.\
It's built with PHP for the backend and HTML+CSS+JS for the frontend.

Technology used:
* Uikit.css CSS library for UI controls of frontend
* MYSQL database + phpmyadmin console for storing information (users, threads, comments, ...)
* JQuery for quick DOM manipulation and AJAX requests
* xampp server

### Project images

This image shows the main page of an authenticated user. He can see, navigate, like and answer the most recent posted threads
[![](https://github.com/vittorioiamarino/forum/blob/master/forum/screens/index_user.png)](#)

This image shows the real-time AJAX search feature. As the user types, JQuery makes Ajax calls to PHP webservice
[![](https://github.com/vittorioiamarino/forum/blob/master/forum/screens/ajax_search.png)](#)

This image shows authentication error
[![](https://github.com/vittorioiamarino/forum/blob/master/forum/screens/authError_guest.png)](#)

User is allerted when his comment has been posted
[![](https://github.com/vittorioiamarino/forum/blob/master/forum/screens/index_user_alterCommentPosted.png)](#)

This image shows a GUEST user trying to make a question, but only logged user can post a thread
[![](https://github.com/vittorioiamarino/forum/blob/master/forum/screens/makeQuestion_guest.png)](#)

This image shows the POPULAR section that shows the most answered threads
[![](https://github.com/vittorioiamarino/forum/blob/master/forum/screens/popular_guest.png)](#)

This image shows a GUEST user that views a thread, it CANNOT answer the question without being logged
[![](https://github.com/vittorioiamarino/forum/blob/master/forum/screens/threadView_guest.png)](#)
