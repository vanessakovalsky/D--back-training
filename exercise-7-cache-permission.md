# Permission et gestion du cache

Cet exercice a pour objectif :
* de déclarer une nouvelle permission
* de gérer le cache du bloc en fonction du contexte

## Gérer le cache du bloc d'aire

* Afin de réactiver le cache sur notre bloc de calcul d'air, nous allons définir un contexte de cache et utiliser les tags afin de demander à Drupal de mettre en cache le bloc en fonction du noeud, cela permettra de bénéficier de la mise en cache de Drupal tout en ayant bien la bonne valeur calculée pour chaque noeud.
* Remplacer la fonction getCacheMaxAge par le code suivant :
```
  public function getCacheTags() {
    //With this when your node change your block will rebuild
    if ($node = \Drupal::routeMatch()->getParameter('node')) {
      //if there is node add its cachetag
      return Cache::mergeTags(parent::getCacheTags(), array('node:' . $node->id()));
    } else {
      //Return default tags instead.
      return parent::getCacheTags();
    }
  }

  public function getCacheContexts() {
    //if you depends on \Drupal::routeMatch()
    //you must set context of this block with 'route' context tag.
    //Every new route this block will rebuild
    return Cache::mergeContexts(parent::getCacheContexts(), array('route'));
  }
```

* Vider le cache de Drupal, et tester sur différents noeuds, le calcul devrait rester bon sur chaque page. 

## Déclarer une nouvelle permission 
* A la racine du module créer un fichier appeler monmodule.permissions.yml 
* Ce fichier sert à déclarer des permissions statique
* Ajouter le code suviant dans ce fichier pour déclarer la permission :
```
administer demo_module_boat configuration:
  title: 'Administer demo_module_boat configuration'
  description: 'Optional description.'
  restrict access: false
```
* Aller dans l'interface vérifier que votre nouvelle permission apparait bien dans la liste (après avoir vider le cache de votre site)
* Donner la permission aux utilisateurs authentifiés (ou à tout autre rôle que vous avez créé)
* Nous allons maintenant associé cette permission au bloc crée dans l'exercice 3, pour cela nous rajoutons une fonction BlockAccess dans le plugin block :
```
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'administer demo_module_boat configuration');
  }
```

## Bonus - Déclarer une permission dynamique

* Ajouter un champs booléen, à vendre dans le type de contenu Bateau. 
* Définir une permission dynamique afin de ne rendre accessible les noeuds de type bateau en lecture que à leur propriétaire sauf si le bateau est à vendre (booléen true)
* 
