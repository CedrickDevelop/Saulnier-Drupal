<?php


namespace Drupal\cp22_saulnier_partners\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\cp22_saulnier_global\Manager\SetCacheManager;
use Drupal\cp22_saulnier_partners\Manager\PartnersTermsManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a partners block list.
 *
 * @Block(
 *   id = "cp22_saulnier_partners_partnersList",
 *   admin_label = @Translation("PartnersList"),
 *   category = @Translation("Custom")
 * )
 */
class PartnersListBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * @var \Drupal\cp22_saulnier_partners\Manager\PartnersTermsManager
   */
  protected $partnersTermsManager;

  /**
   * @var \Drupal\Core\Cache\CacheBackendInterface
   */
  protected $cacheBackend;


  /** Instanciate all the class needed to build */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    PartnersTermsManager $partnersTermsManager,
    CacheBackendInterface $cacheBackend) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->partnersTermsManager = $partnersTermsManager;
    $this->cacheBackend = $cacheBackend;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   *
   * @return \Drupal\cp22_saulnier_partners\Plugin\Block\PartnersListBlock
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): PartnersListBlock {
    $partnersTermsManager = $container->get(PartnersTermsManager::SERVICE_NAME);
    $cache = $container->get('cache.data');
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $partnersTermsManager,
      $cache
    );
  }

  /**
   * Method to build the slider of partners on all menu footer (not partners page)
   * @return array
   */
  public function build(): array {

    $terms = [];
    // Creation du cache
    $cid = 'cp22_saulnier_partners_cache';
    $cache = $this->cacheBackend->get($cid);

    if($cache){
      $terms = $cache->data;
    } else {
      $terms = $this->partnersTermsManager->getbuiltPublishedTermsListByWeight();
      $this->cacheBackend->set($cid, $terms,cacheBackendInterface::CACHE_PERMANENT, ['terms:partners']);
    }

    return [
      "#theme"  => "partners_slider",
      "#partners" => $terms
    ];
  }
}
