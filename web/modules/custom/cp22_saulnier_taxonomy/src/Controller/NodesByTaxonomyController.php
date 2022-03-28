<?php
//
//namespace Drupal\cp22_saulnier_taxonomy\Controller;
//
//use Drupal\Core\Controller\ControllerBase;
//use Drupal\Core\Controller\TitleResolver;
//use Drupal\cp22_saulnier_taxonomy\Manager\NodesByTaxonomyManager;
//
//class NodesByTaxonomyController extends ControllerBase {
//
//  /**
//   * @var \Drupal\cp22_saulnier_taxonomy\Manager\NodesByTaxonomyManager
//   */
//  protected $nodesByTaxonomyManager;
//
//  /**
//   * @var \Drupal\Core\Controller\TitleResolver
//   */
//  protected $titleResolver;
//
//  public function __construct(
//    NodesByTaxonomyManager $nodesByTaxonomyManager,
//    TitleResolver $titleResolver
//  )
//  {
//    $this->nodesByTaxonomyManager = $nodesByTaxonomyManager;
//    $this->titleResolver = $titleResolver;
//  }
//
//  public function content() {
//
//    $nodesNews = $this->nodesByTaxonomyManager->getNodesNewsByTaxonomyOrderByLastChanged();
//
////    // Requete pour recuperer le titre de la page
////    $request = \Drupal::request();
////    $route_match = \Drupal::routeMatch();
////    $title = $this->titleResolver->getTitle($request, $route_match->getRouteObject());
//
//    $title = "Hello";
//
//    return [
//      "#theme"  => "themes_page",
//      "#nodes_news" => $nodesNews,
//      "#title"      => $title
//    ];
//  }
//
//}
