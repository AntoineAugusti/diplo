<?php

// Accueil
Route::get('/', 'WelcomeController@showWelcome');

// Conversations
Route::post('conversations', 'ConversationsController@postConversations');
Route::get('conversations/{conversation}', 'ConversationsController@getConversation');

// Parties
Route::get('parties/{partie}/statut', 'PartiesController@getStatut');
Route::get('parties/{partie}/joueurs', 'PartiesController@getJoueurs');
Route::get('parties/{partie}/phase', 'PartiesController@getPhase');
Route::post('parties/{partie}/rejoindre', 'PartiesController@postRejoindre');

// Queues
Route::post('queue/receive', function () {
    return Queue::marshal();
});
