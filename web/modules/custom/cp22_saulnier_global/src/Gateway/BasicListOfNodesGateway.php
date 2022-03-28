<?php

namespace Drupal\cp22_saulnier_global\Gateway;

use Drupal\Core\Entity\EntityTypeManager;
use Drupal\node\NodeInterface;

/**
 *  Gateway class to get all kind of nodes
 */
class BasicListOfNodesGateway implements BasicListOfNodesGatewayInterface {

  const ENTITY_TYPE_ID = 'node';

  /**
   * @var \Drupal\Core\Entity\EntityTypeManager
   */
  protected $entityTypeManager;

  /**
   * Nodes gateway constructor.
   * @param EntityTypeManager $entityTypeManager
   */
  public function __construct(EntityTypeManager $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * For this Query you can get all kind of nodes you want selected by sopme conditions :
   * filtred by conditions, sort, range and pager.
   * To use this query you only need to send an association key => value
   * for example $condition = ['status' => 1]
   *
   * If you don't need a kind of element you can just send an empty array
   * for example $condition = []
   *
   * @param array $condition
   * @param array $sort
   * @param array $range
   * @param string $pager
   *
   * @return array|int
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function fetchNodesByConditions(array $condition, array $sort, array $range, string $pager) {
    $query = $this->entityTypeManager->getStorage(self::ENTITY_TYPE_ID)
      ->getQuery();

    if (!empty($condition)) {
      foreach ($condition as $key => $value) {
        $query->condition($key, $value);
      }
    }
    if (!empty($sort)) {
      foreach ($sort as $key => $value) {
        $query->sort($key, $value);
      }
    }
    if (!empty($range)) {
      foreach ($range as $key => $value) {
        $query->range($key, $value);
      }
    }

    if (!empty($pager)) {
        $query->pager($pager);
    }

    return $query->execute();
  }



}
