<?php

namespace Drupal\cp22_saulnier_news\Manager;

use Drupal\cp22_saulnier_global\Manager\BasicListOfTaxonomyTermsManager;

/**
 *  Class to get news terms
 */
class NewsTermsManager extends BasicListOfTaxonomyTermsManager {

  const SERVICE_NAME = 'cp22_saulnier_news.news_taxo_manager';

  /**
   * This class get terms to spread on news page and plugins
   * @inheritDoc
   */
  protected function getVocabularyId(): string {
    return 'topics';
  }

}
