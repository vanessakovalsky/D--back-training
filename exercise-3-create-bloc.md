# Exercice 3 : Création d'un bloc et travail avec les BDD

Cet exercice a pour objectifs :
* De créer un bloc custom et de choisir où l'afficher
* De calculer l'aire d'un bateau à partir d'informations enregistrées dans les champs du contenu

## Créer un bloc custom qui ne s'affichera que sur les contenus de type Bateau

* Nous allons utilier la console pour générer un type de bloc 
```
vendor/bin/drupal generate:plugin:block
```
* Une fois le bloc crée afficher le depuis l'interface sur les noeuds de type bateau dans la région de votre choix (via l'interface d'administration)
  
## Calcul d'aire à partir des données du champs

* Le bloc custom que nous avons créé contiendra le calcul de l'aire du bateau (en prenant l'hypothèse que le bateau est rectangulaire, donc le calcul est largeur * longueur)
* Pour cela nous utilisons le service entity.type.manager qui nous permet d'aller récupérer des informations sur une entité et ainsi d'obtenir la valeur des champs de l'entité
* Voici le code de la fonction build qui renvoit le résultat du calcul
```
  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
      $node = $this->requestStack->getCurrentRequest()->attributes->get('node');
      $largeur = $node->get('field_largeur')->getValue()[0]['value'];
      $longueur = $node->get('field_longueur')->getValue()[0]['value'];
      $aire = $longueur * $largeur;
      $build['calcul_aire_block']['#markup'] = 'L\'aire du bateau est égale à :'.$aire;
    return $build;
  }
```
* Afin d'utliser le service (request_stack permettant d'accèder à la requête et ses paramètres), nous devons les injecter dans le constructeur de notre plugin block
 ```php
 class AireBlock extends BlockBase implements ContainerFactoryPluginInterface{
 
  /**
  * Symfony\Component\HttpFoundation\RequestStack definition.
  *
  * @var \Symfony\Component\HttpFoundation\RequestStack
  */
  protected $requestStack;

  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    RequestStack $request_stack
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->requestStack = $request_stack;
  }

    /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('request_stack')
    );
  }
 ```
* En l'état, votre bloc sera mis en cache au premier affichage d'un contenu bateau. Afin de le forcer à calculer avec les bonnes valeurs pour chaque bateau, il est conseiller de désactiver le cache pour ce bloc spécifiquement, pour cela rajouter dans la classe de votre Bloc, la fonction suivante :

```
  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge(){
    return 0;
  }
```
* Vous pouvez maintenant positionner votre bloc et ajouter différents bateaux pour voir le calcul se faire.
