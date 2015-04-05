# Module Conversations

Méthode | URI | Description
------------- | ------------- | -------------
`POST`  | conversations | Crée une nouvelle conversation

## Paramètres de la requête
```json
{
   "joueurs": [1,3]
}
```
## Réponses
### Succès
Renvoie une réponse avec un code HTTP **201**.

#### Exemple de réponse
```json
{
   "id": 1
   "joueurs":[1,3],
   "messages": []
}

#### Description de la réponse
Variable | Type | Description
------------- | ------------- | -------------
`id`  | Entier positif | Identifiant de la conversation créée
`joueurs`  | Tableau d'entiers positifs | Identifiants des joueurs présent dans la conversation
`messages`  | Tableau de Message | Tableau vide


### Erreurs