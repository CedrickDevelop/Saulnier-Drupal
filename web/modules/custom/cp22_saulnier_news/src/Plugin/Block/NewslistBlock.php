<?php

namespace Drupal\cp22_saulnier_news\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\cp22_saulnier_news\Manager\NewsManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a newslist block.
 *
 * @Block(
 *   id = "cp22_saulnier_news_newslist",
 *   admin_label = @Translation("NewsList"),
 *   category = @Translation("Custom")
 * )
 */
class NewslistBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  protected $newsManager;

  /**
   * Constructs a new NewslistBlock instance.
   *
   * @param array $configuration
   *   The plugin configuration, i.e. an array with configuration values keyed
   *   by configuration option name. The special key 'context' may be used to
   *   initialize the defined contexts by setting it to an array of context
   *   values keyed by context names.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The entity type manager.
   * @param NewsManager $newsTermsManager
   *
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, NewsManager $newsTermsManager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->newsManager = $newsTermsManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get(NewsManager::class)
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['content'] = [
      '#markup' => $this->t('Hello'),
    ];

    return $build;
  }

}
