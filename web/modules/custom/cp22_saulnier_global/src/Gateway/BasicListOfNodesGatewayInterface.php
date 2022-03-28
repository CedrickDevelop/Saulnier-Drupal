<?php

namespace Drupal\cp22_saulnier_global\Gateway;

/**
 * Interface Nodes Gateway
 * @package Drupal\cp22_saulnier_global\Gateway
 */
interface BasicListOfNodesGatewayInterface {

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
  public function fetchNodesByConditions(array $condition, array $sort, array $range, string $pager);

}
