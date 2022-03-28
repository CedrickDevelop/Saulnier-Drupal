<?php

namespace Drupal\cp22_saulnier_taxonomy\Gateway;

interface NodesByTaxonomyGatewayInterface {

  public function fetchNodeNewsOrderByLastChangedFiltredByTerm($taxoTid);

}
