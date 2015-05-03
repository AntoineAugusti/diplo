<?php

// Accueil
Route::get('/', 'WelcomeController@showWelcome');

// Conversations
Route::get('conversations/{conversation}', 'ConversationsController@getConversation');
Route::get('conversations/joueurs/{joueur}', 'ConversationsController@getConversationJoueur');
Route::post('conversations', 'ConversationsController@postConversations');
Route::post('conversations/{conversation}/messages', 'ConversationsController@postConversationMessages');

// Parties
Route::get('parties/{partie}/carte', 'PartiesController@getCarte');
Route::get('parties/{partie}/joueurs', 'PartiesController@getJoueurs');
Route::get('parties/{partie}/phase', 'PartiesController@getPhase');
Route::get('parties/{partie}/statut', 'PartiesController@getStatut');
Route::post('parties/{partie}/rejoindre', 'PartiesController@postRejoindre');

// Ordres
Route::post('ordres', 'OrdresController@postOrdre');

// Queues
Route::post('queue/receive', function () {
    return Queue::marshal();
});
