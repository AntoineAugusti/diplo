<?php

Route::get('/', 'WelcomeController@showWelcome');
Route::post('conversations', 'ConversationsController@postConversations');
Route::get('conversations/{conversation}', 'ConversationsController@getConversation');
Route::get('parties/{partie}/statut', 'PartiesController@getStatut');
Route::get('parties/{partie}/joueurs', 'PartiesController@getJoueurs');
Route::get('parties/{partie}/phase', 'PartiesController@getPhase');
Route::post('parties/{partie}/rejoindre', 'PartiesController@postRejoindre');

Route::post('queue/receive', function () {
    return Queue::marshal();
});
