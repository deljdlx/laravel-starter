# Gestion des Permissions (Roles & Permissions Management)

Ce module fournit une interface complète de gestion des rôles et permissions utilisant le package [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission).

## Accès

L'interface de gestion est accessible à l'URL : `/permissions`

## Fonctionnalités

### Gestion des Rôles

- **Créer** : Bouton "Créer un rôle" - permet de créer un nouveau rôle et d'assigner des permissions
- **Modifier** : Clic sur une carte de rôle - permet de modifier le nom et les permissions associées
- **Supprimer** : Bouton supprimer (icône poubelle) - supprime un rôle
- **Rechercher** : Barre de recherche pour filtrer les rôles par nom

### Gestion des Permissions

- **Créer** : Bouton "Créer une permission" - permet de créer une nouvelle permission
- **Modifier** : Bouton modifier (icône crayon) - permet de modifier le nom d'une permission
- **Supprimer** : Bouton supprimer (icône poubelle) - supprime une permission
- **Rechercher** : Barre de recherche pour filtrer les permissions par nom

## API Endpoints

### Rôles

- `GET /permissions/api/roles` - Liste tous les rôles avec leurs permissions
- `POST /permissions/api/roles` - Crée un nouveau rôle
  ```json
  {
    "name": "editor",
    "guard_name": "web",
    "permissions": ["create-posts", "edit-posts"]
  }
  ```
- `GET /permissions/api/roles/{role}` - Détails d'un rôle spécifique
- `PUT /permissions/api/roles/{role}` - Met à jour un rôle
- `DELETE /permissions/api/roles/{role}` - Supprime un rôle

### Permissions

- `GET /permissions/api/permissions` - Liste toutes les permissions
- `POST /permissions/api/permissions` - Crée une nouvelle permission
  ```json
  {
    "name": "create-posts",
    "guard_name": "web"
  }
  ```
- `GET /permissions/api/permissions/{permission}` - Détails d'une permission
- `PUT /permissions/api/permissions/{permission}` - Met à jour une permission
- `DELETE /permissions/api/permissions/{permission}` - Supprime une permission

## Utilisation dans le Code

### Assigner un Rôle à un Utilisateur

```php
use App\Models\User;

$user = User::find(1);
$user->assignRole('editor');
```

### Vérifier les Permissions

```php
// Dans un contrôleur
if ($user->can('create-posts')) {
    // L'utilisateur peut créer des posts
}

// Dans Blade
@can('create-posts')
    <button>Créer un post</button>
@endcan

// Dans les routes
Route::middleware(['can:create-posts'])->group(function () {
    // Routes protégées
});
```

### Vérifier les Rôles

```php
if ($user->hasRole('editor')) {
    // L'utilisateur a le rôle d'éditeur
}

if ($user->hasAnyRole(['editor', 'admin'])) {
    // L'utilisateur a au moins un de ces rôles
}
```

## Sécurité

⚠️ **Important** : Par défaut, les routes de l'API ne sont pas protégées par authentification. Il est fortement recommandé d'ajouter des middlewares d'authentification et d'autorisation :

```php
// Dans routes/web.php
Route::prefix('permissions')
    ->middleware(['auth', 'can:manage-permissions'])
    ->group(function () {
        // Routes...
    });
```

Vous pouvez également implémenter l'autorisation dans les FormRequest classes :

```php
public function authorize(): bool
{
    return $this->user()?->can('create-roles') ?? false;
}
```

## Technologies Utilisées

- **Backend** : Laravel 12, Spatie Permission
- **Frontend** : Tabler UI, Vanilla JavaScript
- **Base de données** : SQLite (configurable)

## Structure des Fichiers

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── RoleController.php
│   │   └── PermissionController.php
│   └── Requests/
│       ├── StoreRoleRequest.php
│       ├── UpdateRoleRequest.php
│       ├── StorePermissionRequest.php
│       └── UpdatePermissionRequest.php
├── Models/
│   └── User.php (avec HasRoles trait)
resources/
└── views/
    └── permissions/
        └── index.blade.php
routes/
└── web.php
```
