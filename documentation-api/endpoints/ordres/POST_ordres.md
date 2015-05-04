# Module Ordres

Méthode | URI | Description
------------- | ------------- | -------------
`POST`  | ordres | Donne les ordres à exécuter pour les armées

## Paramètres de la requête

#### Exemple ordre Tenir
```json
{
   "id_armee":2,
   "ordre":"Tenir"
}
```

#### Exemple ordre Attaquer
```json
{
   "id_armee":1,
   "ordre":"Attaquer",
   "id_case":2
}
```

#### Exemple ordre SoutienDefensif
```json
{
   "id_armee":3,
   "ordre":"SoutienDefensif",
   "id_case":3
}
```

#### Exemple ordre SoutienOffensif
```json
{
   "id_armee":4,
   "ordre":"SoutienOffensif",
   "id_case":2
}
```

Variable | Type | Description
------------- | ------------- | -------------
`id_armee`  | Entier naturel non nul | Identifiant de l'armée concernée par l'ordre
`ordre`  | Chaîne de caractères | Ordre à effectuer, ce champ peut prendre les valeurs : "Tenir", "Attaquer", "SoutienDefensif" ou "SoutienOffensif".
`id_case`  | Entier naturel non nul | Identifiant de la case cible de l'ordre. Ce champ n'est prit en compte que pour les ordres dit *avec cible* ("Attaquer", "SoutienDefensif" ou "SoutienOffensif").

## Réponses
### Succès
Renvoie une réponse avec un code HTTP **202**.

### Erreurs
#### Exemple de réponse
Une erreur renvoie automatiquement un code HTTP de la famille des 400 et un objet JSON contenant au moins les clés `statut` et `erreur`.
```json
{
   "statut":"armee_non_trouvee",
   "erreur":"L'armée 1 n'existe pas"
}
```

```json
{
   "statut":"ordre_inconnu",
   "erreur":"L'ordre Blah n'existe pas. Valeurs possibles : Tenir, Attaquer, SoutienDefensif, SoutienOffensif"
}
```

```json
{
   "statut":"case_non_trouvee",
   "erreur":"La case 2 n'existe pas"
}
```

#### Réponses possibles
Code HTTP | Valeur de `statut` | Valeur de `erreur`
------------- | ------------- | -------------
400  | `ordre_inconnu` | `L'ordre :ordre n'existe pas. Valeurs possibles : Tenir, Attaquer, SoutienDefensif, SoutienOffensif`
404  | `armee_non_trouvee` | `L'armée :id_armee n'existe pas`
404  | `case_non_trouvee` | `La case :id_case n'existe pas`
