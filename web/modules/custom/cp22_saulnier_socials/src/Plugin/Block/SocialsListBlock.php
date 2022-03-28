<?php

namespace Drupal\cp22_saulnier_socials\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\cp22_saulnier_socials\Manager\SocialsManagerInterface;
use Drupal\cp22_saulnier_socials\Manager\SocialsTermsManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a socials block.
 *
 * @Block(
 *   id = "cp22_saulnier_socials_socialsList",
 *   admin_label = @Translation("SocialsList"),
 *   category = @Translation("Custom")
 * )
 */
class SocialsListBlock  extends BlockBase implements ContainerFactoryPluginInterface {


  /**
   * The manager is connected to the gateway
   *
   * @var \Drupal\cp22_saulnier_socials\Manager\SocialsTermsManager
   */
  protected $socialsManager;

  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   *  Basic constructor to instantiate the class needed
   *
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   * @param \Drupal\cp22_saulnier_socials\Manager\SocialsTermsManager $socialsTermsManager
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   */
  public function __construct(
    array                      $configuration,
                               $plugin_id,
                               $plugin_definition,
    SocialsTermsManager        $socialsTermsManager,
    EntityTypeManagerInterface $entityTypeManager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->socialsManager = $socialsTermsManager;
    $this->entityTypeManager = $entityTypeManager;
  }

  public function build(): array {

    return $this->socialsManager->getbuiltPublishedTermsListByWeight();
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   *
   * @return \Drupal\cp22_saulnier_socials\Plugin\Block\SocialsListBlock|static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get(SocialsTermsManager::class),
      $container->get('entity_type.manager')
    );
  }

}
