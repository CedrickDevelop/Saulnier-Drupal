<?php

namespace Drupal\cp22_saulnier_global\Manager;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\cp22_saulnier_global\Gateway\BasicListOfTaxonomyTermsGatewayInterface;

abstract class BasicListOfTaxonomyTermsManager {

  const ENTITY_TYPE_ID = 'taxonomy_term';

  /**
   * Connected to the abstract method
   * @var
   */
  protected $vocabularyId;

  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * @var \Drupal\cp22_saulnier_global\Gateway\BasicListOfTaxonomyTermsGatewayInterface
   */
  protected $BasicTaxonomyGateway;


  /**
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   * @param \Drupal\cp22_saulnier_global\Gateway\BasicListOfTaxonomyTermsGatewayInterface $basicTaxonomyGateway
   */
  public function __construct(
    EntityTypeManagerInterface $entityTypeManager,
    BasicListOfTaxonomyTermsGatewayInterface $basicTaxonomyGateway) {
    $this->entityTypeManager = $entityTypeManager;
    $this->BasicTaxonomyGateway = $basicTaxonomyGateway;

    $this->vocabularyId = $this->getVocabularyId();
  }

  /**
   *  Method to select the vocabulary of the taxonomy query
   */
  abstract protected function getVocabularyId();


  public function getbuiltPublishedTermsListByWeight (): array {
    $build = [];
    $tids = $this->BasicTaxonomyGateway->fetchPublishedTermsByWeight($this->vocabularyId);

    if (!empty($tids)) {
      $view_builder = $this->entityTypeManager
        ->getViewBuilder(self::ENTITY_TYPE_ID);

      $terms = $this->entityTypeManager
        ->getStorage(self::ENTITY_TYPE_ID)
        ->loadMultiple($tids);

      foreach ($terms as $term) {
        $build[] = $view_builder->view($term);
      }
    }
    return $build;
  }

  public function getbuiltPublishedTermsListByWeightByviewMode($viewmode): array {
    $build = [];
    $tids = $this->BasicTaxonomyGateway->fetchPublishedTermsByWeight($this->vocabularyId);

    if (!empty($tids)) {
      $view_builder = $this->entityTypeManager
        ->getViewBuilder(self::ENTITY_TYPE_ID);

      $terms = $this->entityTypeManager
        ->getStorage(self::ENTITY_TYPE_ID)
        ->loadMultiple($tids);

      foreach ($terms as $term) {
        $build[] = $view_builder->view($term, $viewmode);
      }
    }
    return $build;
  }

  /**
   *  Get Published taxonomy on array key => value
   */
  public function getbuiltTerms (): array {

    $listTerm = [];
    $termId = $this->BasicTaxonomyGateway->fetchTerms($this->vocabularyId);

    if(empty($termId)){
      return $listTerm;
    }

    $terms = $this->entityTypeManager->getStorage('taxonomy_term')->loadMultiple($termId);

    // On cree une boucle pour creer le tableau des listes avec la clé c'est l'id et la valeur c'est le nom de la taxonomie
    foreach ($terms as $term) {
      $listTerm[$term->id()] = $term->label();
    }

    return $listTerm;
  }

}
