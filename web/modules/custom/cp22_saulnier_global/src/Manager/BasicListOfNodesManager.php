<?php

namespace Drupal\cp22_saulnier_global\Manager;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\cp22_saulnier_global\Gateway\BasicListOfNodesGatewayInterface;
use Drupal\cp22_saulnier_global\Gateway\BasicListOfTaxonomyTermsGatewayInterface;

class BasicListOfNodesManager implements BasicListOfNodesManagerInterface {

  const ENTITY_TYPE_ID = 'node';

  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * @var \Drupal\cp22_saulnier_global\Gateway\BasicListOfNodesGatewayInterface
   */
  protected $basicNodesGateway;

  /**
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   * @param \Drupal\cp22_saulnier_global\Gateway\BasicListOfNodesGatewayInterface $basicNodesGateway
   */
  public function __construct(
    EntityTypeManagerInterface $entityTypeManager,
    BasicListOfNodesGatewayInterface $basicNodesGateway) {
    $this->entityTypeManager = $entityTypeManager;
    $this->basicNodesGateway = $basicNodesGateway;

  }


  /**
   *
   * For this Method wich access to the gateway, you can get all kind of nodes you want filtred by some conditions :
   * conditions, sort, range and pager.
   * To use this query you only need to send an association key => value in the arguments
   * for example $condition = ['status' => 1]
   *
   * If you don't need a kind of element you can just send an empty array
   * for example $condition = []
   *
   * view will be the view mode you want te get, just send a string
   *
   *
   * @param array $condition
   * @param array $sort
   * @param array $range
   * @param string $pager
   * @param string $viewmode
   *
   * @return array
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function getNodesBuiltViewMultipleByCondition(array $condition, array $sort, array $range, string $pager, string $viewmode): array {

    $builtNodes = [];

    $nodes_id = $this->basicNodesGateway->fetchNodesByConditions($condition, $sort, $range, $pager);

    $nodes = $this->entityTypeManager->getStorage(self::ENTITY_TYPE_ID)->loadMultiple($nodes_id);

    if($nodes) {
      $viewBuilder = $this->entityTypeManager->getViewBuilder(self::ENTITY_TYPE_ID);
      $builtNodes = $viewBuilder->viewMultiple($nodes, $viewmode);
    }

    return $builtNodes;

  }

  /**
   * For this Method wich access to the gateway, you can get all kind of nodes you want filtred by some conditions :
   * conditions, sort, range and pager.
   * To use this query you only need to send an association key => value in the arguments
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
   * @return array
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function getNodesBuiltLoadMultipleByCondition(array $condition, array $sort, array $range, string $pager): array {

    $nodes_id = $this->basicNodesGateway->fetchNodesByConditions($condition, $sort, $range, $pager);

    return $this->entityTypeManager->getStorage(self::ENTITY_TYPE_ID)->loadMultiple($nodes_id);

  }

  /**
   * For this Method wich access to the gateway, you can get all kind of nodes you want filtred by some conditions :
   * conditions, sort, range and pager.
   * To use this query you only need to send an association key => value in the arguments
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
  public function getNodesIdByCondition(array $condition, array $sort, array $range, string $pager) {
    return $this->basicNodesGateway->fetchNodesByConditions($condition, $sort, $range, $pager);
  }

}
