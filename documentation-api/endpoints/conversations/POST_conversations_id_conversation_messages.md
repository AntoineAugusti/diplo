# Module Conversations

Méthode | URI | Description
------------- | ------------- | -------------
`POST`  | conversations/`:id_conversation`/messages | Crée un nouveau message dans une conversation

## Paramètres de la requête
```json
{
   "id_joueur":2,
   "texte":"Bonjour, comment ça va ?"
}
```

Variable | Type | Description
------------- | ------------- | -------------
`id_conversation`  | Entier naturel non nul | Identifiant de la conversation
`id_joueur`  | Entier naturel non nul | Identifiant du joueur émetteur du message
`texte`  | Chaîne de caractères | Texte du message

## Réponses
### Succès
Renvoie une réponse avec un code HTTP **201**.

#### Exemple de réponse
```json
{
   "id": 1,
   "id_joueur":2,
   "texte":"Bonjour, comment ça va ?",
   "created_at":"1975-12-25 14:15:16"
}
```

#### Description de la réponse
Variable | Type | Description
------------- | ------------- | -------------
`id`  | Entier naturel non nul | Identifiant du message créé
`id_joueur`  | Entier naturel non nul | Identifiants du joueur émetteur du message
`texte`  | Chaîne de caractères | Texte du message
`created_at`  | Chaîne de caractères | Date de création du message sous la forme "YYYY-MM-DD HH:MM:SS"

### Erreurs
#### Exemple de réponse
Une erreur renvoie automatiquement un code HTTP de la famille des 400 et un objet JSON contenant au moins les clés `statut` et `erreur`.
```json
{
   "statut":"non_trouve",
   "erreur":"La conversation 42 n'existe pas"
}
```

```json
{
   "statut":"joueur_non_present",
   "erreur":"Le joueur 2 n'est pas présent dans la conversation"
}
```

#### Réponses possibles
Code HTTP | Valeur de `statut` | Valeur de `erreur`
------------- | ------------- | -------------
404  | `non_trouve` | `La conversation :id_conversation n'existe pas`
403  | `joueur_non_present` | `Le joueur :id_joueur n'est pas présent dans la conversation`
