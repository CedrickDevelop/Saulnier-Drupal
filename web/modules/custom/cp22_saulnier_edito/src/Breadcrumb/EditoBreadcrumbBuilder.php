<?php

namespace Drupal\cp22_saulnier_edito\Breadcrumb ;

use Drupal\Core\Breadcrumb\Breadcrumb;
use Drupal\Core\Breadcrumb\BreadcrumbBuilderInterface;
use Drupal\Core\Controller\TitleResolver;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\Link;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\cp22_saulnier_edito\Manager\EditoManager;
use Symfony\Component\HttpFoundation\RequestStack;

class EditoBreadcrumbBuilder implements BreadcrumbBuilderInterface {

  /**
   * @var \Drupal\Core\Breadcrumb\Breadcrumb
   */
  protected $breadcrumb;

  /**
   * @var \Drupal\Core\Language\LanguageManagerInterface
   */
  protected $languageManager;

  /**
   * @var \Symfony\Component\HttpFoundation\Request
   */
  protected $requestStack;

  /**
   * @var \Drupal\Core\Controller\TitleResolver
   */
  protected $titleResolver;

  /**
   * @var \Drupal\cp22_saulnier_edito\Manager\EditoManager
   */
  protected $editoManager;


  /**
   * @param \Drupal\Core\Language\LanguageManagerInterface $languageManager
   * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
   * @param \Drupal\Core\Controller\TitleResolver $titleResolver
   */
  public function __construct(
    LanguageManagerInterface $languageManager,
    RequestStack             $requestStack,
    TitleResolver            $titleResolver,
    EditoManager             $editoManager) {
    $this->breadcrumb = new Breadcrumb();
    $this->languageManager = $languageManager;
    $this->requestStack = $requestStack;
    $this->titleResolver = $titleResolver;
    $this->editoManager = $editoManager;
  }

  /**
   * @inheritDoc
   */
  public function applies(RouteMatchInterface $route_match): bool {
    $nodeEntity = $route_match->getParameter('node');
    //    $nodeType = $nodeEntity->getType();
    if (isset($nodeEntity) && ($nodeEntity->getType() === 'news')) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * @inheritDoc
   */
  public function build(RouteMatchInterface $route_match): Breadcrumb {
    // INITIALISATION
    $link = [];

    // Route à la main
    //    Link::fromTextAndUrl(t('Home'), Url::fromUserInput('http://google.fr'));

    // PAGE D'ACCUEIL
    $link[] = Link::createFromRoute(t('Home'), '<front>');

    // LA PAGE DE LISTE
    $editoListNode = $this->editoManager->getEditoListNode();
    if (!empty($editoListNode)) {
      // Methode avec l'url
      $listUrl = $editoListNode->toUrl();
      $link[] = Link::fromTextAndUrl($editoListNode->label(), $listUrl);

      // LA PAGE EN COURS
      $nodeEntity = $route_match->getParameter('node');
      $langId = $this->languageManager->getCurrentLanguage()->getId();

      if ($nodeEntity->hasTranslation($langId)) {
//        $nodeEntityTrans = $nodeEntity->getTranslation($langId);
        $nodeEntity= $nodeEntity->getTranslation($langId);
      }
      $title = $nodeEntity->label();
      $link[] = Link::createFromRoute($title, '<none>');

    }

    return $this->breadcrumb->setLinks($link);
  }

}
