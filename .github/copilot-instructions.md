# GitHub Copilot – Instructions projet

## Contexte général
Ce projet est une application Laravel 12 utilisant :
- PHP 8.x
- Laravel 12.x
- Tabler comme base UI (Blade components + classes CSS)
- Docker pour l’environnement de dev

L’architecture doit rester simple, lisible, orientée “maintenabilité” et non “hype”.

## Style de code attendu

- Respecter les conventions Laravel 12 (PSR-12, noms de classes, namespaces, etc.).
- Toujours typer au maximum :
  - types scalaires (`string`, `int`, `bool`, `array`, etc.)
  - types de retour (`: void`, `: ?Model`, `: Collection`, etc.)
- Viser niveau max phpstan (pas de `@phpstan-ignore` sauf cas très particulier).


## Migrations et modèles

Quand tu génères :

- Un **modèle Eloquent** :
  - Déclarer les propriétés PHPDoc pour les colonnes et relations.


## Tests

- Privilégier les **tests de feature** Laravel pour vérifier les endpoints principaux.
- Quand tu génères du code non trivial (service, diff de schéma, etc.), proposer aussi un **test de base** correspondant.
- Les tests vont dans `tests/Feature` ou `tests/Unit` selon le cas.

## Ce que je veux que tu fasses (Copilot)

Quand je commente ou écris du code :

1. **Toujours proposer des solutions compatibles Laravel 12.**
2. **Ne pas inventer de packages gratuits/obscurs au hasard.**  
   - Éviter d’ajouter des dépendances Composer ou NPM sauf si je le demande explicitement.
3. **Préférer le code simple et lisible** plutôt qu’une solution “trop smart”.
4. Si tu dois générer plusieurs éléments liés (migration + modèle + contrôleur + FormRequest + routes), :
   - Proposer une vision d’ensemble dans un commentaire / section.
   - Générer le code fichier par fichier, de manière cohérente.

## Ce que je ne veux PAS

- Pas de code orienté “demo quick & dirty” si le contexte est manifestement du code applicatif sérieux.
- Pas de mélange sauvage de logique métier dans les contrôleurs si le cas d’usage mérite un service dédié.
- Pas de helpers globaux sur-utilisés (`helper()` partout) au lieu de classes structurées.
- Ne pas supposer que le projet utilise Inertia, Livewire, Vue ou React **sans indication explicite**.

## Ton comportement par défaut

- Quand le contexte n’est pas clair, **faire des hypothèses minimalistes**, pas des stacks complètes.
- Éviter la génération de gros blocs monolithiques impossibles à maintenir.
- Si tu complètes du code existant, respecter **le style déjà présent dans le fichier** (nommage, indentation, patterns, etc.).


## Code javascript / front-end
- Privilégier la POO JS (classes, modules) quand le contexte le justifie.
- Documenter les fonctions et classes avec des commentaires JSDoc.
- Bien lister les propriétés d’un objet ou d’une classe. Ne pas utiliser des objets “libres” sans structure claire.