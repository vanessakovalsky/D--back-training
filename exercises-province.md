# Exercice D9 : 

Nous allons structurer un site pour le faire en D9.

## Cahier des charges

Voici la liste des attendus : 

Un portail unique, sur une instance Drupal unique, avec des dizaines de sections différentes (enseignement, culture, sport,...) qui sont en réalité des sous-sites

### Contenu

- Les types de contenu transversaux (pages, articles, évènements,...) doivent être attachés à une section

- Des types de contenu spécifiques sont utilisés uniquement par une section

- Le portail présente sur sa page d'accueil le contenu transversal toutes sections confondues

- Chaque section possède sa propre page d'accueil

- L'ensemble du contenu peut être traduit en une ou plusieurs langues

### Menus

- Le portail présente, au travers d'un menu global, l'ensemble des sections organisées par thèmes

- Chaque section possède son propre menu

### Rôles

- Administrateurs généraux (homepage + toutes sections)

- Administrateurs de section

- Rédacteurs par section

### OPTIONNEL - Templates

- Un template Demo est appliqué à la page d'accueil principale et à certaines pages transversales

- Certaines sections ont vocation à se voir appliquer le template Demo

- Chaque section possède éventuellement son propre template (à défaut, le template Demo est appliqué)

### OPTIONNEL - Divers

- Chaque section possède sa propre newsletter

- Chaque section possède son propre formulaire de contact

- Chaque section possède éventuellement ses propres réseaux sociaux

- Des modules spécifiques offrent des outils métier liés à une seule section

### OPTIONNEL - URL

- Chaque section dispose éventuellement de son propre nom de domaine (à défaut, demodrupal.com) > visible en permanence, pas une simple redirection

## Exercices

### Exercice 1 : Créer les sections
* Installer le module Groups et configurer le :
```
composer require drupal/group 
```
* Activer le module dans l'interface ou via la console ou drush
* Aller dans Groups dans la barre d'administration : 
- quels sont les éléments disponibles
-> un groupe = une section du site
* Créer plusieurs groupes représentant les différentes sections
* Qu'est ce que le module rajoute ?
* Allez explorer les fichiers du modules pour essayer de déterminer les éléments ajouter

### Exercice 2: créer les types de contenus :
* Créer un type de contenu évènements  générique pour toutes les sections
* Créer un type de contenu spécifique à une section 
* Pour les deux contenus créér différents contenus (le module devel generate https://www.drupal.org/project/devel peut vous aider à générer du contenu de manière automatiser)

### Exercice 3  : Création de vue sur la page d'accueil et pour chaque section
* Créer une vue bloc listant les évènements de l'ensemble des groupes
* Positionner le bloc sur la page d'accueil du site
* Créer une vue avec le type de contenu spécifique 
* Afficher cette vue sur la page de la section


### Exercice 4 : Gérer les menus 
* Utiliser le menu principal de Drupal pour ajouter les sections que vous avez créer et quelques pages pertienentes
* Installer et activer le module group_content_menu
* Créer un menu par section et rattacher les au groupe pour permettre aux administrateurs du groupes de le gérer

### Exercice 5 : Gestions des droits 
* Créer un rôle : administrateur général
* Donner lui permissions nécessaires à gérer l'ensemble des contenus du site ainsi que des sections (groupe)
* Créer un compte avec ce rôle
* Se connecter avec le compte créé et vérifier que le compte a bien accès aux éléments qu'il doit modifier (contenu, menus, sections)
* Créer deux comptes et les associer à une section
* Définir l'un des comptes comme administrateur du groupe, l'autre comme simple membre
* Se connecter successivement avec chacun de ses comptes pour vérifier ce que chaque compte peut faire

### Exercice 6 : Formulaires de contacts
* Créer un formulaire de contact pour chaque section 
* Ajouter dans le menu de chaque section le lien vers son propre formulaire de contact


### Exercice 7 : exporter la configuration dans un module
* Nous allons créer un premier module pour placer l'ensemble des configurations effectuées.
* Pour cela nous allons utiliser Drupal Console. 
```
vendor\bin\drupal generate:module
```
* La console pose alors une série de question pour la génération du module
* Une fois le module crée, celui ci se trouve dans web/modules/custom/nom_du_module 
* Il doit contenir à minima un fichier nom_du_module.info.yml 
* Nous créons alors un dossier config dans le dossier de notre module, puis un sous-dossier install 
* Ensuite nous utilisons de nouveau la console pour exporter les configurations. Les différentes options disponibles sont : 
* * config:export -> Exporte la configuration actuelle de l'application.
* * config:export:content:type -> Exporte un type de contenu avec les champs qui le composent.
* * config:export:entity -> Exporte une entité de configuration et ses champs
* * config:export:single -> Exporte une unique configuration sous la forme d'un fichier YAML.
* * config:export:view -> Exporte une vue vue dans le format YAML au sein d'un module pour la réutiliser sur un autre site.
* Il est alors nécessaire d'identifier l'ensemble des configurations nécessaires.
* Pour cela il est conseillé d'avoir un deuxième drupal vierge et de tester son module au fur et à mesure (il faut systèmatiquement réinstaller un drupal vierge, ou positionner la config dans le dossier optionnal et non install pour pouvoir l'installer / le desinstaller plusieurs fois sans messages d'erreurs) 




