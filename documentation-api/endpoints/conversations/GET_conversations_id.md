# Module Conversations

Méthode | URI | Description
------------- | ------------- | -------------
`GET`  | conversations/`:id` | Retourne la conversation `:id`

## Paramètres de la requête
Variable | Type | Description
------------- | ------------- | -------------
`:id`  | Entier naturel | Spécifie l'identifiant de la conversation

## Réponses
### Succès
Renvoie une réponse avec un code HTTP **200**.

#### Exemple de réponse
```json
{
	"id": 1
	"joueurs":[1,3],
	"messages": [
		{
			"joueur": 1
			"texte": "Bonjour, ça va ?"
		},
		{
			"joueur": 3
			"texte": "Oui et toi ?"
		}
	]
}
```
#### Description de la réponse
Variable | Type | Description
------------- | ------------- | -------------
`joueurs`  | Tableau d'entiers positifs | Identifiants des joueurs présent dans la conversation
messages.`joueur`  | Entier positif | Identifiant du joueur à l'origine du message
messages.`texte`  | Chaîne de caractère | Texte du message

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