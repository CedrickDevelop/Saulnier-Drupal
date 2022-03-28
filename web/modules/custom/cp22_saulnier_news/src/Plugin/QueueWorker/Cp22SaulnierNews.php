<?php

namespace Drupal\cp22_saulnier_news\Plugin\QueueWorker;

use Drupal\Core\Queue\QueueWorkerBase;
use Drupal\taxonomy\Entity\Term;

/**
 * Defines 'cp22_saulnier_news_queueworker' queue worker.
 *
 * @QueueWorker(
 *   id = "cp22_saulnier_news_queueworker",
 *   title = @Translation("QueueWorker"),
 *   cron = {"time" = 60}
 * )
 */
class Cp22SaulnierNews extends QueueWorkerBase {

  /**
   * {@inheritdoc}
   */
  public function processItem($data) {
//    $term = Term::create([
//      'vid' =>  'topics',
//      'name' => $data
//    ]);
//
//    $term->save();
  }

}
