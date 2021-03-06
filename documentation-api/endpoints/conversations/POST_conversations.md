# Module Conversations

Méthode | URI | Description
------------- | ------------- | -------------
`POST`  | conversations | Crée une nouvelle conversation entre des joueurs

## Paramètres de la requête
```json
{
   "joueurs":[1, 3]
}
```

Variable | Type | Description
------------- | ------------- | -------------
`joueurs`  | Tableau d'entiers naturels non nuls | Identifiants des joueurs à ajouter à la conversation

## Réponses
### Succès
Renvoie une réponse avec un code HTTP **201**.

#### Exemple de réponse
```json
{
   "id": 1,
   "joueurs":[1,3],
   "messages": []
}
```

#### Description de la réponse
Variable | Type | Description
------------- | ------------- | -------------
`id`  | Entier naturel non nul | Identifiant de la conversation créée
`joueurs`  | Tableau d'entiers naturels non nuls | Identifiants des joueurs présents dans la conversation, dans l'ordre croissant
`messages`  | Tableau de Message | Tableau vide

### Erreurs
#### Exemple de réponse
Une erreur renvoie automatiquement un code HTTP de la famille des 400 et un objet JSON contenant au moins les clés `statut` et `erreur`.

```json
{
   "statut":"joueur_non_present",
   "erreur":"Au moins un des joueurs n'existe pas. Impossible de créer la conversation"
}
```

#### Réponses possibles
Code HTTP | Valeur de `statut` | Valeur de `erreur`
------------- | ------------- | -------------
400  | `manque_joueurs` | `Une conversation ne peut être créée qu'entre deux joueurs ou plus`
400  | `joueur_duplique` | `Un joueur ne peut être plus d'une fois dans la même conversation`
403  | `joueur_non_present` | `Au moins un des joueurs n'existe pas. Impossible de créer la conversation`
403  | `partie_phase_combat` | `La partie :id est en phase de combat`
403  | `parties_differentes` | `Les joueurs ne sont pas dans la même partie`
403  | `partie_invalide` | `La partie :id n'est pas en jeu : la partie peut être en attente de joueurs ou terminée`
403  | `conversation_existante` | `Une conversation entre ces joueurs existe déjà. Utilisez cette conversation`
