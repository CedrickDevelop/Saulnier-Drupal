<?php

namespace Drupal\cp22_saulnier_edito\Manager;

/**  To get the edito project nodes   */
interface EditoManagerInterface
{

  /**
   * Get until 6 edito published Nodes, sort by desc on changed on viewmode full
   * @return array
   */
  public function getAllPublishedNodesEditoBuilt():array;

  /**
   * Get until 1 edito published Nodes, sort by desc.
   * Usefull for the breadcrumb
   * @return mixed
   */
  public function getEditoListNode();

}
