<?php

namespace Drupal\cp22_saulnier_partners\Manager;

use Drupal\cp22_saulnier_global\Manager\BasicListOfTaxonomyTermsManager;

/**
 * This class get terms to spread on partners sliders
 *
 */
class PartnersTermsManager extends BasicListOfTaxonomyTermsManager {

  const SERVICE_NAME = 'cp22_saulnier_partners.partners_manager';

  /**
   *  With this method we calibrate the vocabulary to access on getbuiltPublishedTermsListByWeight ()
   */
  protected function getVocabularyId(): string {
    return 'partners';
  }

}
