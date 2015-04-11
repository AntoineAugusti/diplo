# Module Conversations

Méthode | URI | Description
------------- | ------------- | -------------
`GET`  | conversations/joueurs/`:id` | Retourne les conversations où le joueur `:id` est inscrit

## Paramètres de la requête
Variable | Type | Description
------------- | ------------- | -------------
`:id`  | Entier naturel non nul | Spécifie l'identifiant du joueur

## Réponses
### Succès
Renvoie une réponse avec un code HTTP **200**.

#### Exemple de réponse
```json
{
   "conversations":[
      {
         "id":1,
         "joueurs":[1,3]
      },
      {
         "id":4,
         "joueurs":[1,5,7]
      }
   ]
}
```
#### Description de la réponse
Variable | Type | Description
------------- | ------------- | -------------
conversations.`id`  | Entier naturel non nul | Identifiant de la conversation
conversations.`joueurs`  | Tableau d'entiers positifs | Identifiants des joueurs présents dans la conversation

**Note** : il est possible que `conversations` soit un tableau vide si le joueur n'est inscrit à aucune conversation pour le moment.

### Erreurs
#### Exemple de réponse
Une erreur renvoie automatiquement un code HTTP de la famille des 400 et un objet JSON contenant au moins les clés `statut` et `erreur`.
```json
{
   "statut":"joueur_inexistant",
   "erreur":"Le joueur 42 n'existe pas"
}
```

#### Réponses possibles
Code HTTP | Valeur de `statut` | Valeur de `erreur`
------------- | ------------- | -------------
404  | `joueur_inexistant` | `Le joueur :id n'existe pas`