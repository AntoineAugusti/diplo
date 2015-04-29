# Module Parties

Méthode | URI | Description
------------- | ------------- | -------------
`GET`  | parties/`:id`/carte | Donne des informations sur la carte `:id`

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
    "cases": [
        {
            "id":1,
            "est_libre":false,
            "id_joueur":1,
            "est_occupee":false,
            "id_armee":null,
            "id_cases_voisines": [
               2 
            ]
        },
        {
            "id":2,
            "est_libre": true,
            "id_joueur":null,
            "est_occupee":true,
            "id_armee":1,
            "id_cases_voisines": [
               1 
            ]
        }
    ],
    "nb_cases":2
}
```
#### Description de la réponse
Variable | Type | Description
------------- | ------------- | -------------
`nb_cases` | Entier naturel non nul | Le nombre de cases de le carte
*cases*.`id`  | Entier naturel non nul | L'identifiant de la case
*cases*.`est_libre`  | Booléen | Vrai si la case est possédée par un joueur, faux sinon
*cases*.`id_joueur`  | Entier naturel non nul | L'identifiant du joueur si `est_libre` vaut faux, null sinon
*cases*.`est_occupee`  | Booléen | Vrai si une armée est sur la case, faux sinon
*cases*.`id_armee`  | Entier naturel non nul | L'identifiant de l'armée si `est_occupee` vaut vrai, null sinon
*cases*.`id_cases_voisines`  | Tableau d'entiers naturels | Les identifiants des cases voisines

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
