<?php

Route::get('/', 'WelcomeController@showWelcome');
Route::get('parties/{partie}/statut', 'PartiesController@getStatut');
Route::get('parties/{partie}/joueurs', 'PartiesController@getJoueurs');
Route::post('parties/{partie}/rejoindre', 'PartiesController@postRejoindre');

Route::post('queue/receive', function()
{
    return Queue::marshal();
});
