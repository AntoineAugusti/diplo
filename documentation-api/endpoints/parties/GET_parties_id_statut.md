# Module Parties

Méthode | URI | Description
------------- | ------------- | -------------
`GET`  | parties/`:id`/statut | Donne des informations sur le statut de la partie `:id`

## Paramètres de la requête
Variable | Type | Description
------------- | ------------- | -------------
`:id`  | Entier naturel non nul | Spécifie l'identifiant de partie

## Réponses
### Succès
Renvoie une réponse avec un code HTTP **200**.

#### Exemple de réponse
```json
{
   "statut":"attente_joueurs",
   "message":"Il n'y a pas assez de joueurs pour démarrer la partie"
}
```
#### Description de la réponse
Variable | Type | Description
------------- | ------------- | -------------
`statut`  | Chaîne de caractères | Une clé donnant des informations sur le statut d'une partie
`message`  | Chaîne de caractères | Un message, lisible humainement, donnant des informations sur le statut d'une partie

#### Réponses possibles
Valeur de `statut` | Valeur de `message` | Description
------------- | ------------- | -------------
`attente_joueurs` | `Il n'y a pas assez de joueurs pour démarrer la partie` | Il n'y a pas assez de joueurs pour démarrer la partie
`en_jeu` | `La partie est en cours` | La partie est en cours. Pour avoir des informations sur le déroulement du jeu, il faut appeler `GET` `parties/:id/statut`.
`fin` | `La partie est terminée` | La partie est terminée. Pour déterminer si la partie est un match nul ou le joueur gagnant, il faut appeler `GET` `parties/:id/joueurs`

### Erreurs
#### Exemple de réponse
Une erreur renvoie automatiquement un code HTTP de la famille des 400 et un objet JSON contenant au moins les clés `statut` et `erreur`.
```json
{
   "statut":"non_trouve",
   "erreur":"La partie 42 n'existe pas"
}
```

#### Réponses possibles
Code HTTP | Valeur de `statut` | Valeur de `erreur`
------------- | ------------- | -------------
404  | `non_trouve` | `La partie :id n'existe pas`