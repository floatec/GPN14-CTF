<?php

require('app/core/autoloader.php');

//define routes
Router::get('/', 'rezepte@index');


Router::get('/user', 'members@index');
Router::post('/user', 'members@index');
Router::get('/user/memberspage', 'members@memberspage');
Router::get('/user/login', 'members@login');
Router::post('/user/login', 'members@login');
Router::get('/user/logout', 'members@logout');


Router::get('/rezepte', 'rezepte@index');
Router::get('/rezepte/hinzufuegen', 'rezepte@add');
Router::post('/rezepte/hinzufuegen', 'rezepte@add');




//if no route found
Router::error('error@index');

//execute matched routes
Router::dispatch();
ob_flush();
