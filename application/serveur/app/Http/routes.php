<?php


Route::get('parties/{partie}/statut', 'PartiesController@getStatut');
Route::get('parties/{partie}/joueurs', 'PartiesController@getJoueurs');
