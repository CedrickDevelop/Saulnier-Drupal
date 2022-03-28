<?php

namespace Drupal\cp22_saulnier_partners\Controller;

use Drupal\adimeo_tools\Service\LanguageService;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Controller\TitleResolver;
use Drupal\cp22_saulnier_partners\Manager\PartnersTermsManager;

class PartnersController extends ControllerBase {

  /**
   * @var \Drupal\cp22_saulnier_partners\Manager\PartnersTermsManager
   */
  protected $partnersTermsManager;

  /**
   * @var \Drupal\adimeo_tools\Service\LanguageService
   */
  protected $languageService;

  /**
   * @var \Drupal\Core\Controller\TitleResolver
   */
  protected $titleResolver;

  public function __construct(
    PartnersTermsManager $partnersTermsManager,
    LanguageService $languageService,
    TitleResolver $titleResolver
  ) {
    $this->partnersTermsManager = $partnersTermsManager;
    $this->languageService = $languageService;
    $this->titleResolver = $titleResolver;
  }


  public function content() {

    $partnersTerms = $this->partnersTermsManager->getbuiltPublishedTermsListByWeightByviewMode("teaser_page");
//    $language = $this->languageService->getCurrentLanguageId();

//    $url = \Drupal\Core\Url::fromRoute('<current>')->toString();
//    $url_page = explode('/', $url);
//    if ($url_page[2] == "partenaires" || $url_page[2] == "partners"){
//      $title = $this->t('Les partenaires');
//    }

    // Requete pour recuperer le titre de la page
    $request = \Drupal::request();
    $route_match = \Drupal::routeMatch();
    $title = $this->titleResolver->getTitle($request, $route_match->getRouteObject());

    $build = [
      "#theme"  => "partners_page",
      "#list_partners" => $partnersTerms,
      "#title"  => $title
    ];
    return $build;

  }

}
