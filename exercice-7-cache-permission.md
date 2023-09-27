# Permission et gestion du cache

Cet exercice a pour objectif :
* de déclarer une nouvelle permission
* de gérer le cache du bloc en fonction du contexte

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
