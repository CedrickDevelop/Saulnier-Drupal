<?php

namespace Drupal\cp22_saulnier_socials\Manager;

use Drupal\cp22_saulnier_global\Manager\BasicListOfTaxonomyTermsManager;

/**
 *  This class get terms to spread on socials icons
 */
class SocialsTermsManager extends BasicListOfTaxonomyTermsManager{

  const SERVICE_NAME = 'cp22_saulnier_socials.socials_manager';

  /**
   *   With this method we calibrate the vocabulary to access on getbuiltPublishedTermsListByWeight ()
   */
  protected function getVocabularyId(): string {
    return 'network';
  }


}
