<?php

namespace Drupal\cp22_saulnier_taxonomy\Gateway;

use Drupal\Core\Entity\EntityTypeManagerInterface;

class NodesByTaxonomyGateway implements NodesByTaxonomyGatewayInterface{

  const ENTITY_TYPE_NODE = 'node';

  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  public function __construct(
    EntityTypeManagerInterface $entityTypeManager
  )
  {
    $this->entityTypeManager = $entityTypeManager;
  }

  public function fetchNodeNewsOrderByLastChangedFiltredByTerm($taxoTid)
  {
    $query = $this->entityTypeManager->getStorage(self::ENTITY_TYPE_NODE)->getQuery();
    $query->condition('type', 'news')
          ->condition('field_theme', $taxoTid)
          ->sort('changed', 'DESC');


    return $query->execute();
  }

}
