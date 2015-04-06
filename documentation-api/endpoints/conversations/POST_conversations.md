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
`id`  | Entier positif | Identifiant de la conversation créée
`joueurs`  | Tableau d'entiers naturels non nuls | Identifiants des joueurs présents dans la conversation
`messages`  | Tableau de Message | Tableau vide

### Erreurs
Il n'y a pas d'erreurs possibles.