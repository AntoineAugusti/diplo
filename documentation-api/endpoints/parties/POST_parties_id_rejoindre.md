# Module Parties

Méthode | URI | Description
------------- | ------------- | -------------
`POST`  | parties/`:id`/rejoindre | Demande à rejoindre la partie `:id` et renvoie les informations générées automatiquement pour le joueur ayant demandé à rejoindre la partie

## Paramètres de la requête
Variable | Type | Description
------------- | ------------- | -------------
`:id`  | Entier naturel | Spécifie l'identifiant de partie

## Réponses
### Succès
Renvoie une réponse avec un code HTTP **201**.

#### Exemple de réponse
```json
{
   "partie":{
      "id":1,
      "nb_joueurs_requis":5,
      "nb_joueurs_inscrits":3
   },
   "joueur":{
      "id":2,
      "pseudo":"Blah",
      "pays":"FRA"
   }
}
```
#### Description de la réponse
Variable | Type | Description
------------- | ------------- | -------------
*partie*.`id`  | Entier naturel | L'identifiant de la partie
*partie*.`nb_joueurs_requis`  | Entier naturel | Le nombre de joueurs requis avant de démarrer la partie
*partie*.`nb_joueurs_inscrits`  | Entier naturel | Le nombre de joueurs inscrits dans la partie
*joueur*.`id`  | Entier naturel | L'identifiant du joueur ayant demandé à rejoindre la partie
*joueur*.`pseudo`  | Chaîne de caractères | Le pseudonyme du joueur ayant demandé à rejoindre la partie
*joueur*.`pays`  | Chaîne de caractères | Le code du pays du joueur ayant demandé à rejoindre la partie au format [ISO 3166-1 alpha-3](http://en.wikipedia.org/wiki/ISO_3166-1_alpha-3)

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
400  | `partie_pleine` | `La partie :id est pleine`