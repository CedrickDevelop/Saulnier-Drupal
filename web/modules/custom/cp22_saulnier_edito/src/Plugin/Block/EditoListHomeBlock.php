<?php


namespace Drupal\cp22_saulnier_edito\Plugin\Block;


use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\cp22_saulnier_edito\Manager\EditoManager;
use Drupal\cp22_saulnier_edito\Manager\EditoManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides the 6 lasts edito node list on Home page
 *
 * @Block(
 *   id = "cp22_saulnier_edito_homelist",
 *   admin_label = @Translation("Home list edito"),
 *   category = @Translation("Custom")
 * )
 */
class EditoListHomeBlock extends BlockBase implements ContainerFactoryPluginInterface
{

  /**
   * @var EditoManagerInterface
   */
    protected $editoManager;

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
   * @param EditoManager $editoTermsManager
   */
    public function __construct(array $configuration, $plugin_id, $plugin_definition, EditoManager $editoTermsManager)
    {
      parent::__construct($configuration, $plugin_id, $plugin_definition);
      $this->editoManager = $editoTermsManager;
    }


  /**
   * {@inheritdoc}
   */
    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
    {
      return new static(
        $configuration,
        $plugin_id,
        $plugin_definition,
        $container->get(EditoManager::class)
      );
    }
    /**
     * {@inheritdoc}
     */
      public function build()
      {

        return $this->editoManager->getAllPublishedNodesEditoBuilt();
      }
}
