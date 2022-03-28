<?php


namespace Drupal\cp22_saulnier_news\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\cp22_saulnier_news\Form\NewsListFormFilter;

/**
 * Provides a filter Block for the news list page
 *
 * @Block(
 *   id = "cp22_saulnier_news_news_list_filter",
 *   admin_label = @Translation("News list filter block"),
 *   category = @Translation("Custom")
 * )
 */
class NewsListFilterFormBlock extends BlockBase implements ContainerFactoryPluginInterface
{
  /**
   * @var FormBuilderInterface
   */
  private $formBuilder;

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
   * @param FormBuilderInterface $formBuilder
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $formBuilder) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->formBuilder = $formBuilder;

  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('form_builder')
    );
  }

    /**
     * {@inheritdoc}
     */
    public function build() {
      return $this->formBuilder->getForm(NewsListFormFilter::class);
    }


}
