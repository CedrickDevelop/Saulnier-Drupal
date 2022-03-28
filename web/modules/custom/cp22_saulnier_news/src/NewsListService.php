<?php

//namespace Drupal\cp22_saulnier_news;
//
//use Drupal;
//use Drupal\Core\Entity\EntityTypeManagerInterface;
//use Drupal\node\NodeInterface;
//
///**
// * NewsListService service.
// */
//class NewsListService {
//
//  /**
//   * The entity type manager.
//   *
//   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
//   */
//  protected $entityTypeManager;
//
//  /**
//   * Constructs a NewsListService object.
//   *
//   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
//   *   The entity type manager.
//   */
//  public function __construct(EntityTypeManagerInterface $entity_type_manager) {
//    $this->entityTypeManager = $entity_type_manager;
//  }
//
//  /**
//   * Cette méthode est appelée dasn le hook preprocess pour charger les informations du node
//   */
//  public function addNewsListToNodePreprocessVariableIfNeeded($variables) {
//    /** @var \Drupal\node\NodeInterface $node */
//    // Recuperation du node à partir des variables
//    $node = $variables['node'];
//
//    if ($node->bundle() !== 'news_list'){
//      return;
//    }
//
////    /** @var \Drupal\core\Entity\EntityTypeManagerInterface $etm */
////    // Appel de l'entitytypemanager
////    $etm = Drupal::entityTypeManager();
//
//    // On remplace l'appelle de l'entity manager par un appelle au construct
//    $etm = $this->entityTypeManager;
//    $nodeStorage = $etm->getStorage('node');
//
//    // On accède au storage du node
//    $query = $nodeStorage->getQuery();
//
//    // Pour afficher les nodes publiés on utilise le status publié
//    $query->condition('status', NodeInterface::PUBLISHED);
//
//    // On choisit la condition du type de node à recuperer
//    $query->condition('type', 'news');
//
//    // On execute la requete pour recuperer les informations
//    //  On recuperer une liste d'ids'
//    $newsIdList = $query->execute();
//
//
//    // Une fois la variable definit elle est transmise directement au template
//    //  voir le template node--news-list
//    // La variable qui part vers le template c'est ce qui est entre crochets
//
//    return $nodeStorage->loadMultiple($newsIdList);;
//  }


  //////////////////////////////////////////////////////////////////////////
  /// CORRECTION DU CODE DE SERVICE
  //////////////////////////////////////////////////////////////////////////

namespace Drupal\cp22_saulnier_news;

  use Drupal\Core\Entity\EntityTypeManagerInterface;
  use Drupal\node\NodeInterface;

  /**
   * NewsListService service.
   */
class NewsListService {

  const NEWS_LIST_BUNDLE = 'news_list';

  const NODE_TYPE = 'node';

  const NODE_PARAM_IN_PREPROCESS_VARIABLES = 'node';

  /**
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  private $nodeStorage;

  /**
   * Constructs a NewsListService object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager) {
    $this->nodeStorage = $entity_type_manager->getStorage(self::NODE_TYPE);
  }

  /**
   * @param array $variables Variables from hook_preprocess_node
   *
   * @return array
   */
  public function addNewsListToNodePreprocessVariableIfNeeded(array $variables): array {
    if (!$this->isVariableCurrentNodeANewsList($variables)) {
      return $variables;
    }
    $variables['newsList'] = $this->getAllPublishedNodes();
    return $variables;
  }

  protected function isVariableCurrentNodeANewsList(array $variables): bool {
    /** @var NodeInterface $node */
    $node = $variables[self::NODE_PARAM_IN_PREPROCESS_VARIABLES];
    return $this->isNodeANewsList($node);
  }

  protected function isNodeANewsList(NodeInterface $node): bool {
    return $node->bundle() === self::NEWS_LIST_BUNDLE;
  }

  /**
   * @return NodeInterface[]
   */
  public function getAllPublishedNodes(): array {
    return $this->nodeStorage->loadMultiple($this->getAllPublishedNodesNid());
  }

  /**
   * @return int[]
   */
  protected function getAllPublishedNodesNid(): array {
    $query = $this->nodeStorage->getQuery();
    $query->condition('status', NodeInterface::PUBLISHED);
    $query->condition('type', 'news');
    return $query->execute();
  }

}

//}


