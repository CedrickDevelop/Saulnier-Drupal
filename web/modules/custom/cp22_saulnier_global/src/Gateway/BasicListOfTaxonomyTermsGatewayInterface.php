<?php

namespace Drupal\cp22_saulnier_global\Gateway;

/**
 * Interface TaxonomyGatewayInterface
 * @package Drupal\cp22_saulnier_global\Gateway
 */
interface BasicListOfTaxonomyTermsGatewayInterface {

  /**
   * Method to get Taxo published sort by weight
   * @param $vid
   * @return array
   */
  public function fetchPublishedTermsByWeight($vid) : array;

  public function fetchTerms($vid);
}
