# Mona Page Builder

Plugin WordPress réutilisable pour les sites MonaGraphic.

## Principe

Le plugin fournit :

- les layouts ACF du Page Builder ;
- le HTML et le JavaScript fonctionnels ;
- une feuille CSS neutre minimale pour éviter les composants cassés ou sans structure ;
- les composants Texte, Texte + image, Témoignage, Image, Bouton, Citation, Galerie, Organigramme, Accordéon et Onglets ;
- une toolbar WYSIWYG dédiée au Page Builder.

Le thème fournit la direction artistique et peut surcharger les templates du plugin.

## ACF Pro

ACF Pro est requis.

Le groupe de champs est chargé depuis `acf/`.

## Surcharge par le thème

Un template placé dans le thème à :

`template-parts/page-builder/{layout}.php`

prend la priorité sur le template fourni par le plugin.

## CSS

Le plugin charge `assets/css/page-builder.css` uniquement sur les contenus utilisant le champ `page_builder`.

Ce CSS est volontairement neutre. Le thème peut le surcharger avec ses propres règles.

## Mise à jour

La mise à jour automatique n'est pas incluse dans cette version. Les nouvelles versions peuvent être installées manuellement depuis l'administration WordPress.

## Compatibilité avec le thème

Les thèmes existants peuvent continuer à appeler :

`get_template_part( 'template-parts/page-builder/' . $layout );`

Le plugin fournit automatiquement le template si le thème ne possède pas de surcharge correspondante.

## Galerie

Le layout Galerie ouvre les images dans une lightbox et permet de naviguer entre les images de la même galerie avec les boutons ou les flèches du clavier. Échap ferme la lightbox.


### FAQ Mona FAQ

Si le plugin Mona FAQ est actif et que le CPT `faq` est enregistré, un layout `FAQ Mona FAQ` apparaît dans le Page Builder. Il permet de sélectionner plusieurs questions existantes et les affiche avec le même accordéon que le Page Builder. Si Mona FAQ est absent, le layout n'est pas proposé.


## FAQ Mona FAQ

Le layout `FAQ Mona FAQ` est disponible uniquement lorsque le plugin `mona-faq` est actif et que son CPT `faq` est enregistré. Il est distinct du layout `Accordéon`, qui conserve ses propres questions et réponses dans le Page Builder.


## Post types supportés

Le Page Builder est disponible sur :
- `page`
- `testimonial`
- `contributeur`
