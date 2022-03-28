<?php

  namespace Drupal\cp22_saulnier_taxonomy\Manager;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\cp22_saulnier_taxonomy\Gateway\NodesByTaxonomyGateway;

class NodesByTaxonomyManager {

  const ENTITY_TYPE_NODE = "node";

  const TERM_BUNDLE = "topics";

  const VIEWMODE = "teaser_taxonomy_page";

  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * @var \Drupal\cp22_saulnier_taxonomy\Gateway\NodesByTaxonomyGateway
   */
  protected $nodesByTaxonomyGateway;

  public function __construct(
    EntityTypeManagerInterface $entityTypeManager,
    NodesByTaxonomyGateway $nodesByTaxonomyGateway
  )
  {
    $this->entityTypeManager = $entityTypeManager;
    $this->nodesByTaxonomyGateway = $nodesByTaxonomyGateway;
  }

  /**
   * Get the nodes news built to send on the page of the taxonomy term
   * Theses nodes are ordered by last changes
   *
   * @return array
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function getNodesNewsByTaxonomyOrderByLastChanged($taxoTid): array {
    $nodesId = $this->nodesByTaxonomyGateway->fetchNodeNewsOrderByLastChangedFiltredByTerm($taxoTid);
    $builtNodes = [];

    if(!$nodesId){
      return $builtNodes;
    }

    $nodesLoaded = $this->entityTypeManager
      ->getStorage(self::ENTITY_TYPE_NODE)
      ->loadMultiple($nodesId);

    if($nodesLoaded) {
      $builtNodes = $this->entityTypeManager
        ->getViewBuilder(self::ENTITY_TYPE_NODE)
        ->viewMultiple($nodesLoaded, self::VIEWMODE);
      //***************** Creation du teaser pour ces nodes *******************
    }

    return $builtNodes;

  }

}
