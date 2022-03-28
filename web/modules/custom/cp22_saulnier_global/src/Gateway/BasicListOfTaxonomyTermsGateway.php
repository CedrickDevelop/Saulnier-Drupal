<?php

namespace Drupal\cp22_saulnier_global\Gateway;

use Drupal\Core\Entity\EntityTypeManager;
use Drupal\node\NodeInterface;

/**
 *  Gateway class to get the taxonomy term
 */
class BasicListOfTaxonomyTermsGateway implements BasicListOfTaxonomyTermsGatewayInterface{

  const ENTITY_TYPE_ID = 'taxonomy_term';

  /**
   * @var EntityTypeManager
   */
  protected $entityTypeManager;


  /**
   * @param \Drupal\Core\Entity\EntityTypeManager $entityTypeManager
   */
  public function __construct(EntityTypeManager $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   *  Method to get Taxo published sort by weight
   */
  public function fetchPublishedTermsByWeight($vid): array {
    return $this->entityTypeManager->getStorage(self::ENTITY_TYPE_ID)
      ->getQuery()
      ->condition('vid', $vid)
      ->condition('status', NodeInterface::PUBLISHED)
      ->sort('weight', 'ASC')
      ->execute();
  }

  /**
   *  Method to get Taxo Published
   */
  public function fetchTerms($vid){
    return $this->entityTypeManager->getStorage(self::ENTITY_TYPE_ID)
      ->getQuery()
      ->condition('vid', $vid)
      ->execute();
  }

}
