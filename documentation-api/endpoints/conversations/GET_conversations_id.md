# Module Conversations

Méthode | URI | Description
------------- | ------------- | -------------
`GET`  | conversations/`:id` | Retourne la conversation `:id`

## Paramètres de la requête
Variable | Type | Description
------------- | ------------- | -------------
`:id`  | Entier naturel non nul | Spécifie l'identifiant de la conversation

## Réponses
### Succès
Renvoie une réponse avec un code HTTP **200**.

#### Exemple de réponse
```json
{
   "id":1,
   "joueurs":[1, 3],
   "messages":[
      {
         "joueur":1,
         "texte":"Bonjour, ça va ?",
         "created_at":"2014-12-31 11:55:00"
      },
      {
         "joueur":3,
         "texte":"Oui et toi ?",
         "created_at":"2014-12-31 12:00:00"
      }
   ]
}
```
#### Description de la réponse
Variable | Type | Description
------------- | ------------- | -------------
`id`  | Entier naturel non nul | Identifiant de la conversation
`joueurs`  | Tableau d'entiers positifs | Identifiants des joueurs présents dans la conversation
messages.`joueur`  | Entier naturel non nul | Identifiant du joueur à l'origine du message
messages.`texte`  | Chaîne de caractères | Texte du message
messages.`created_at`  | Chaîne de caractères | La date de création du message, au format `YYYY-MM-DD HH:MM:SS` et au fuseau horaire UTC

### Erreurs
#### Exemple de réponse
Une erreur renvoie automatiquement un code HTTP de la famille des 400 et un objet JSON contenant au moins les clés `statut` et `erreur`.
```json
{
   "statut":"non_trouve",
   "erreur":"La conversation 42 n'existe pas"
}
```

#### Réponses possibles
Code HTTP | Valeur de `statut` | Valeur de `erreur`
------------- | ------------- | -------------
404  | `non_trouve` | `La conversation :id n'existe pas`