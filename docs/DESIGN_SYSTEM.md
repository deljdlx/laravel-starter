# Design System Documentation

## Overview
Dark modern design system avec palette Slate/Cyan/Purple inspirée des UI type Vercel/Linear.

## CSS Variables (Design Tokens)

### Colors

#### Backgrounds
- `--ds-bg-primary`: #0f172a (Fond principal)
- `--ds-bg-secondary`: #1e293b (Cards, éléments secondaires)
- `--ds-bg-tertiary`: #334155 (Borders, états interactifs)
- `--ds-bg-hover`: #475569 (État hover)

#### Accents
- `--ds-accent-cyan`: #06b6d4 (Links, actions principales)
- `--ds-accent-purple`: #a855f7 (Badges, highlights)
- `--ds-accent-pink`: #ec4899 (Accents tertiaires)

#### Text
- `--ds-text-primary`: #f1f5f9 (Texte principal)
- `--ds-text-secondary`: #94a3b8 (Texte secondaire)
- `--ds-text-tertiary`: #64748b (Texte désactivé)
- `--ds-text-muted`: #475569 (Texte très discret)

#### Status
- `--ds-success`: #10b981
- `--ds-warning`: #f59e0b
- `--ds-error`: #ef4444
- `--ds-info`: #3b82f6

### Spacing
- `xs`: 0.25rem (4px)
- `sm`: 0.5rem (8px)
- `md`: 1rem (16px)
- `lg`: 1.5rem (24px)
- `xl`: 2rem (32px)
- `2xl`: 3rem (48px)
- `3xl`: 4rem (64px)

### Border Radius
- `sm`: 6px
- `md`: 12px
- `lg`: 16px
- `xl`: 24px
- `full`: 9999px

### Typography
- Font sans: Inter, system fonts
- Font mono: JetBrains Mono, Monaco, Menlo

#### Sizes
- `xs`: 0.75rem
- `sm`: 0.85rem
- `base`: 1rem
- `lg`: 1.125rem
- `xl`: 1.25rem
- `2xl`: 1.5rem
- `3xl`: 2rem

#### Weights
- Normal: 400
- Medium: 500
- Semibold: 600
- Bold: 700
- Extrabold: 800

## Components

### Header
```html
<div class="ds-header">
    <div class="container-xl">
        <h1 class="ds-header-title">Titre</h1>
        <p class="ds-header-subtitle">Sous-titre</p>
    </div>
</div>
```

### Card
```html
<div class="ds-card">
    Contenu de la card
</div>
```
Effet: hover avec lift + border top gradient animé

### Badges
```html
<span class="ds-badge ds-badge-primary">Primary</span>
<span class="ds-badge ds-badge-secondary">Secondary</span>
<span class="ds-badge ds-badge-success">Success</span>
<span class="ds-badge ds-badge-count">42</span>
```

### Buttons
```html
<button class="ds-btn ds-btn-primary">Primary</button>
<button class="ds-btn ds-btn-secondary">Secondary</button>
<button class="ds-btn ds-btn-ghost">Ghost</button>
```

### Grid
```html
<div class="ds-grid ds-grid-auto">
    <!-- Auto-fill minmax(280px, 1fr) -->
</div>

<div class="ds-grid ds-grid-3">
    <!-- 3 colonnes fixes -->
</div>
```

### Category Section
```html
<div class="ds-category-section">
    <div class="ds-category-header">
        <h2 class="ds-category-title">Catégorie</h2>
        <span class="ds-badge-count">12</span>
    </div>
    <!-- Contenu -->
</div>
```

### Footer
```html
<footer class="ds-footer">
    <div class="container-xl">
        <p><a href="#">Link</a></p>
    </div>
</footer>
```

## Utility Classes

### Typography
- `.ds-text-{primary|secondary|tertiary|muted}`
- `.ds-text-{xs|sm|base|lg|xl|2xl|3xl}`
- `.ds-font-{normal|medium|semibold|bold}`
- `.ds-font-mono`

### Spacing
- `.ds-mt-{xs|sm|md|lg|xl}` (margin-top)
- `.ds-mb-{xs|sm|md|lg|xl}` (margin-bottom)
- `.ds-p-{xs|sm|md|lg|xl}` (padding)

### Misc
- `.ds-link`: lien avec couleur cyan/purple hover
- `.ds-divider`: séparateur horizontal
- `.ds-container`: conteneur centré max-width 1280px
- `.ds-section`: section avec margin-bottom

## Usage

### Import
```blade
@vite(['resources/css/app.css', 'resources/css/design-system.css'])
```

### HTML Tag
```html
<html lang="en" data-bs-theme="dark">
```

## Best Practices

1. **Toujours utiliser les CSS variables** au lieu de valeurs hardcodées
2. **Préfixer les classes custom** avec `ds-` pour éviter les conflits
3. **Utiliser les utility classes** pour l'espacement plutôt que du CSS custom
4. **Respecter la hiérarchie typographique** (primary > secondary > tertiary)
5. **Cards cliquables**: toujours wrapper dans un `<a>` avec `.ds-route-link`

## Responsive

- Grid passe automatiquement en 1 colonne sur mobile (< 768px)
- Header title réduit sur mobile
- Spacing responsive géré via les variables

## Transitions

- Fast: 150ms (micro-interactions)
- Base: 300ms (hover, focus)
- Slow: 500ms (animations complexes)

Toutes utilisent `cubic-bezier(0.4, 0, 0.2, 1)` pour une courbe naturelle.
