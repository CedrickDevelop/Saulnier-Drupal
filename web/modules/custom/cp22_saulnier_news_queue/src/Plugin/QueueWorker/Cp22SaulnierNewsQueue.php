<?php

namespace Drupal\cp22_saulnier_news_queue\Plugin\QueueWorker;

use Drupal\Core\Queue\QueueWorkerBase;

/**
 * Defines 'cp22_saulnier_news_queue_queueworkernews' queue worker.
 *
 * @QueueWorker(
 *   id = "cp22_saulnier_news_queue_queueworkernews",
 *   title = @Translation("QueueWorkerNews"),
 *   cron = {"time" = 60}
 * )
 */
class Cp22SaulnierNewsQueue extends QueueWorkerBase {

  /**
   * {@inheritdoc}
   */
  public function processItem($data) {
    // @todo Process data here.
  }

}
