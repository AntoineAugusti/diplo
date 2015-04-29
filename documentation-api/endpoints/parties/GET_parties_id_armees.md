# Module Parties

Méthode | URI | Description
------------- | ------------- | -------------
`GET`  | parties/`:id`/armees| Donne des informations sur les armées de la partie `:id`

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
    "armees": [
        {
            "id_armee":1,
            "id_joueur":3,
            "id_case_courante":6
        },
        {
            "id_armee":2,
            "id_joueur":3,
            "id_case_courante":5
        }
    ],
    "nb_armees":2
}
```
#### Description de la réponse
Variable | Type | Description
------------- | ------------- | -------------
`nb_armees` | Entier naturel non nul | Le nombre d'armées de la partie  
*armees*.`id_armee` | Entier naturel non nul | L'identifiant de l'armee
*armees*.`id_joueur` | Entier naturel non nul | L'identifiant du joueur
*armees*.`id_case_courante` | Entier naturel non nul | L'identifiant de la case courante

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
