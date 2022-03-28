<?php

namespace Drupal\cp22_saulnier_edito\Manager;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\cp22_saulnier_global\Manager\BasicListOfNodesManagerInterface;

/** Transform the nodes Edito project  */
class EditoManager implements EditoManagerInterface {

  const NODE_ENTITY_TYPE_ID = 'node';

  /**
   * @var EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * @var CacheBackendInterface
   */
  protected $cacheBackend;

  /**
   * @var \Drupal\cp22_saulnier_global\Manager\BasicListOfNodesManagerInterface
   */
  protected $basicListOfNodesManager;

  public function __construct(
    EntityTypeManagerInterface $entityTypeManager,
    BasicListOfNodesManagerInterface $basicListOfNodesManager) {
    $this->entityTypeManager = $entityTypeManager;
    $this->basicListOfNodesManager = $basicListOfNodesManager;
  }


  /**
   * Get until 6 edito published Nodes, sort by desc on changed on viewmode full
   * @return array
   */
  public function getAllPublishedNodesEditoBuilt(): array {
    $condition = [
      'status' => 1,
      'type'  =>  'project_edito'
    ];
    $sort = [
      'changed' => 'DESC'
    ];
    $range = [0 => 6];
    $pager="";
    $view = 'full';

    return $this->basicListOfNodesManager
      ->getNodesBuiltViewMultipleByCondition($condition, $sort, $range, $pager, $view);

  }

  /**
   * Get until 1 edito published Nodes, sort by desc.
   * Usefull for the breadcrumb
   * @return array|\Drupal\Core\Entity\EntityInterface|null
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function getEditoListNode() {

    $condition = [
      'status' => 1,
      'type'  =>  'project_edito'
    ];
    $sort = [
      'changed' => 'DESC'
    ];
    $range = [0 => 1];
    $pager="";

    $node_id = $this->basicListOfNodesManager->getNodesIdByCondition($condition, $sort, $range, $pager);

    $editoList = [];
    if ($node_id) {
      $editoList = $this->entityTypeManager->getStorage('node')
        ->load(reset($node_id));
    }

    return $editoList;
}

}
