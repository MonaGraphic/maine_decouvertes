# Mona FAQ

Plugin autonome pour gérer et afficher des questions fréquentes dans WordPress.

## Pré-requis

- WordPress 6.8 minimum
- PHP 8.3 minimum
- aucune dépendance tierce
- pas de thème custom requis
- pas d’ACF requis

## Installation

1. Copier le dossier `mona-faq` dans `wp-content/plugins/`.
2. Dans l’administration WordPress, aller dans Extensions.
3. Cliquer sur "Activer" pour Mona FAQ.

## Activation

Le plugin enregistre automatiquement le CPT FAQ et le bloc Gutenberg associé.

## Créer une FAQ

1. Ouvrir le menu FAQ dans le back-office.
2. Cliquer sur Ajouter une FAQ.
3. Saisir la question dans le titre.
4. Rédiger la réponse dans le contenu de l’éditeur.
5. Définir l’ordre avec le champ Ordre si nécessaire.

## Utiliser le bloc FAQ

1. Ouvrir Gutenberg.
2. Ajouter le bloc FAQ.
3. Sélectionner les FAQ à afficher.
4. Réorganiser leur ordre dans le bloc.
5. Publier la page ou l’article.

## Classement

Les FAQ sont affichées selon l’ordre choisi dans le bloc. Les éléments supprimés ou non publiés sont ignorés sans erreur.

## Accessibilité

Le composant utilise un vrai bouton natif, `aria-expanded`, `aria-controls`, `aria-labelledby` et `hidden` pour un comportement clavier et lecteur d’écran conforme.

## Architecture

- `mona-faq.php` : point d’entrée du plugin.
- `src/class-plugin.php` : orchestration du plugin.
- `src/PostType/class-faq.php` : enregistrement du CPT FAQ.
- `src/Block/class-faq.php` : enregistrement du bloc Gutenberg.
- `src/Lifecycle/class-activator.php` : activation.
- `src/Lifecycle/class-deactivator.php` : désactivation.
- `blocks/faq/` : bloc dynamique et rendu serveur.
- `assets/faq.js` : script frontend vanilla.

## Développement

Commandes disponibles :

```bash
composer install
composer cs
composer analyse
```

## Dépendances

Aucune dépendance runtime. Le plugin n’utilise ni jQuery, ni React, ni Node.js, ni framework frontend.
