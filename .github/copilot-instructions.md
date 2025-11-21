# GitHub Copilot – Instructions projet

## Contexte
Laravel 12, PHP 8.x, Tabler UI, Docker dev.
Code simple, lisible, maintenable.

## Règles de code
Respect strict des conventions Laravel 12 (PSR-12, typage maximal, PHPDoc sur modèles et relations).
Niveau max phpstan (éviter @phpstan-ignore).
Pas de dépendances externes sauf demande explicite.

## Génération de code
Pour chaque nouvelle entité : migration, modèle, contrôleur, FormRequest, routes.
Proposer une vision d’ensemble, puis générer chaque fichier séparément.
Tests : privilégier les tests de feature pour les endpoints, tests unitaires pour la logique métier.

## Structure
Pas de logique métier dans les contrôleurs si un service est justifié.
Pas de helpers globaux abusifs.
Ne pas supposer l’usage d’Inertia, Livewire, Vue, React sans indication.

## Front-end
Privilégier la POO JS si pertinent.
Documenter les classes/fonctions JS (JSDoc).
Utiliser des objets/classe bien structurés.

## Comportement
Hypothèses minimalistes si le contexte est flou.
Respect du style existant lors de la complétion.
Préférer la clarté à la “smartitude”.