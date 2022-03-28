<?php

namespace Drupal\cp22_saulnier_news_list\Manager;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Url;
use Drupal\cp22_saulnier_global\Manager\BasicListOfNodesManagerInterface;


/**
 * NewsListService Manager.
 */
class NewsListManager implements NewsListManagerInterface{
  const NEWS_LIST_BUNDLE = 'news_list';

  const NEWS_LIST_PREPROCESS_KEY = 'newsList';

  const NODE_ENTITY_TYPE_ID = 'node';

  /** @var EntityTypeManagerInterface  */
  protected $entityTypeManager;

  /**
   * @var \Drupal\cp22_saulnier_global\Manager\BasicListOfNodesManagerInterface
   */
  protected $basicListOfNodesManager;

  /**
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   * @param \Drupal\cp22_saulnier_global\Manager\BasicListOfNodesManagerInterface $basicListOfNodesManager
   */
  public function __construct(
    EntityTypeManagerInterface $entityTypeManager,
    BasicListOfNodesManagerInterface $basicListOfNodesManager) {
    $this->entityTypeManager = $entityTypeManager;
    $this->basicListOfNodesManager = $basicListOfNodesManager;
  }

  /**
   * This method provide a button to access on the news list page
   * @return array
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function getLinkButtonNewsList(): array {

    $condition = [
      'status' => 1,
      'type'  =>  'news_list'
    ];
    $sort = [];
    $range = [];
    $pager = "";

    $nodes_id = $this->basicListOfNodesManager->getNodesIdByCondition($condition, $sort , $range, $pager);

    $newsList = [];
    if ($nodes_id) {
      $newsList = $this->entityTypeManager->getStorage('node')
        ->load(reset($nodes_id));
    }

    //On génére l'url avec la fonction fromRoute avec comme argument le nom de la route, et un tableau d'argument
    $url=Url::fromRoute('entity.node.canonical', ['node'=>$newsList->id()]);

    //Il reste plus qu'à générer le lien
    return [
      '#type' => 'link',
      '#url' => $url,
      '#title' => [
        '#type'=>'button',
        '#value'=> t('Toutes les actualités'),
      ]
    ];
  }

  /**
   * This method provide the news information built inside the breadcrumb
   * @return array|\Drupal\Core\Entity\EntityInterface|null
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function getNewsListNode() {
    $condition = [
      'status' => 1,
      'type'  =>  'newslist'
    ];
    $sort = [
      'changed' => 'DESC'
    ];
    $range = [0 => 1];
    $pager = "";

    $nodes_id = $this->basicListOfNodesManager->getNodesIdByCondition($condition, $sort , $range, $pager);

    $newsList = [];
    if ($nodes_id) {
      $newsList = $this->entityTypeManager->getStorage(self::NODE_ENTITY_TYPE_ID)
        ->load(reset($nodes_id));
    }

    return $newsList;

  }

  /**
   * Build the news node published sort by changed with a pager of 5 nodes in view mode teaser
   * @return array
   */
  public function getBuiltNewsNodeForNewsListPage(): array {

    $condition = [
      'status' => 1,
      'type'  =>  'news'
    ];
    $sort = [
      'changed' => 'DESC'
    ];
    $range = [];
    $pager = 5;
    $view = 'teaser';

    $builtNodes = $this->basicListOfNodesManager->getNodesBuiltViewMultipleByCondition(
      $condition, $sort , $range, $pager, $view );

    // Creation du tableau de cache à envoyer à la vue
    $builtNodes['#cache']['tags'] = ['node_list:news'];

    return $builtNodes;

  }


  /**
   * Build the news node published sort by changed with a pager of 5 nodes in view mode teaser
   * This query is filtred by term and date
   * @param $termId
   * @param $date
   *
   * @return array
   */
  public function getBuiltNewsNodeForNewsListPageByTermId($termId, $date): array {

    $condition = [
      'status' => 1,
      'type'  =>  'news',
      'field_theme' => $termId
    ];
    $sort = [
      'created' => $date
    ];
    $range = [];
    $pager=5;
    $view = 'teaser';

    $builtNodes = $this->basicListOfNodesManager->getNodesBuiltViewMultipleByCondition(
      $condition, $sort , $range, $pager, $view );

    // Creation du tableau de cache à envoyer à la vue
    $builtNodes['#cache']['tags'] = ['node_list:news'];

    return $builtNodes;
  }


}
