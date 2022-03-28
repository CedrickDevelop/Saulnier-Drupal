<?php

namespace Drupal\cp22_saulnier_global\Manager;

interface BasicListOfNodesManagerInterface {

  /**
   * For this Method wich access to the gateway, you can get all kind of nodes you want filtred by some conditions :
   * conditions, sort, range and pager.
   * To use this query you only need to send an association key => value in the arguments
   * for example $condition = ['status' => 1]
   *
   * If you don't need a kind of element you can just send an empty array
   * for example $condition = []
   *
   * view will be the view mode you want te get, just send a string
   * @param array $condition
   * @param array $sort
   * @param array $range
   * @param string $pager
   * @param string $viewmode
   *
   * @return mixed
   */
  public function getNodesBuiltViewMultipleByCondition(array $condition, array $sort, array $range, string $pager, string $viewmode);

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
   * @return mixed
   */
  public function getNodesBuiltLoadMultipleByCondition(array $condition, array $sort, array $range, string $pager);

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
   * @return mixed
   */
  public function getNodesIdByCondition(array $condition, array $sort, array $range, string $pager);
}
