<?php

namespace Drupal\cp22_saulnier_news\Manager;


use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\cp22_saulnier_global\Manager\BasicListOfNodesManagerInterface;
/**
 * Manager for the News Nodes
 */
class NewsManager {

  const NEWS_LIST_BUNDLE = 'news_list';

  const NEWS_LIST_PREPROCESS_KEY = 'newsList';

  /** @var EntityTypeManagerInterface  */
  protected $entityTypeManager;

  /** @var BasicListOfNodesManagerInterface */
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
   * @return array
   */
  public function getLinks(): array {

    $condition = [
      'status' => 1,
      'type'  =>  'news',
      'promote' => true
    ];
    $sort = [
      'changed' => 'DESC'
    ];
    $range = [0 => 4];
    $pager = "";

    $newsList = $this->basicListOfNodesManager->getNodesBuiltLoadMultipleByCondition(
      $condition, $sort , $range, $pager);

    $link = [];
    foreach ($newsList as $node){
      $options = ['absolute' => TRUE];
      $link[$node->id()] = Drupal\Core\Url::fromRoute('entity.node.canonical', ['node' => $node->id()], $options);

    }
    return $link ;
  }

  /**
   * @return array
   */
  public function getPublishedNodes(): array {

    $view = 'teaser_homepage';
    $condition = [
      'status' => 1,
      'type'  =>  'news',
      'promote' => true
    ];
    $sort = [
      'changed' => 'DESC'
    ];
    $range = [0 => 4];
    $pager="";

    return $this->basicListOfNodesManager->getNodesBuiltViewMultipleByCondition(
      $condition, $sort , $range, $pager, $view );

  }


}
