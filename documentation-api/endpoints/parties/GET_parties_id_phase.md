# Module Parties

Méthode | URI | Description
------------- | ------------- | -------------
`GET`  | parties/`:id`/phase | Donne les informations sur la phase en cours de la partie `:id`

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
   "phase":"NEGOCIATION",
   "chrono": 42
}
```
#### Description de la réponse
Variable | Type | Description
------------- | ------------- | -------------
`phase`  | Chaîne de caractères | Phase courante de la partie
`chrono`  | Entier naturel non nul | Nombre de secondes restantes pour cette phase

Valeurs possibles de `phase` :
- `NEGOCIATION` : phase de négociation
- `COMBAT` : phase de combat

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
405  | `partie_invalide` | `La partie :id n'est pas en jeu : la partie peut être en attente de joueurs ou terminée`
