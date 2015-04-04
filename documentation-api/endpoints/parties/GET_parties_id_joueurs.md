# Module Parties

Méthode | URI | Description
------------- | ------------- | -------------
`GET`  | parties/`:id`/joueurs | Donne des informations sur les joueurs qui ont rejoint la partie `:id`

## Paramètres de la requête
Variable | Type | Description
------------- | ------------- | -------------
`:id`  | Entier naturel | Spécifie l'identifiant de partie

## Réponses
### Succès
Renvoie une réponse avec un code HTTP **200**.

#### Exemple de réponse
```json
{
   "joueurs":[
      {
         "id":1,
         "pseudo":"Fake",
         "pays":"FRA",
         "armees_restantes":10,
         "cases_controlees":3
      },
      {
         "id":2,
         "pseudo":"Dummy",
         "pays":"GBR",
         "armees_restantes":5,
         "cases_controlees":2
      }
   ],
   "nb_joueurs":2
}
```
#### Description de la réponse
Variable | Type | Description
------------- | ------------- | -------------
`nb_joueurs`  | Entier naturel | Le nombre de joueurs participant à la partie
*joueurs*.`id`  | Entier naturel | L'identifiant du joueur
*joueurs*.`pseudo`  | Chaîne de caractères | Le pseudonyme du joueur
*joueurs*.`pays`  | Chaîne de caractères | Le code du pays du joueur au format [ISO 3166-1 alpha-3](http://en.wikipedia.org/wiki/ISO_3166-1_alpha-3)
*joueurs*.`armees_restantes`  | Entier naturel | Le nombre d'unités restantes pour le joueur
*joueurs*.`cases_controlees`  | Entier naturel | Le nombre de cases contrôlées par le joueur

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