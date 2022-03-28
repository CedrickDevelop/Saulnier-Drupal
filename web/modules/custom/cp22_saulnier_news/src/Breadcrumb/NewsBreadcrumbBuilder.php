<?php

namespace Drupal\cp22_saulnier_news\Breadcrumb ;

use Drupal\Core\Breadcrumb\Breadcrumb;
use Drupal\Core\Breadcrumb\BreadcrumbBuilderInterface;
use Drupal\Core\Controller\TitleResolver;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\Link;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\cp22_saulnier_news_list\Manager\NewsListManager;
use Symfony\Component\HttpFoundation\RequestStack;

class NewsBreadcrumbBuilder implements BreadcrumbBuilderInterface {

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
   * @var \Drupal\cp22_saulnier_news_list\Manager\NewsListManager
   */
  protected $newsListManager;

  /**
   * @param \Drupal\Core\Language\LanguageManagerInterface $languageManager
   * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
   * @param \Drupal\Core\Controller\TitleResolver $titleResolver
   * @param \Drupal\cp22_saulnier_news_list\Manager\NewsListManager $newsListManager
   */
  public function __construct(
    LanguageManagerInterface $languageManager,
    RequestStack             $requestStack,
    TitleResolver            $titleResolver,
    NewsListManager $newsListManager)

  {
    $this->breadcrumb = new Breadcrumb();
    $this->languageManager = $languageManager;
    $this->requestStack = $requestStack;
    $this->titleResolver = $titleResolver;
    $this->newsListManager = $newsListManager;
  }


  /**
   * @inheritDoc
   */
  public function applies (RouteMatchInterface $route_match): bool {
    $nodeEntity = $route_match->getParameter('node');
//    $nodeType = $nodeEntity->getType();
    if(isset($nodeEntity)  && ($nodeEntity->getType() === 'news')){
      return true;
    }
    return false;
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
    $newsListNode = $this->newsListManager->getNewsListNode();
    if(!empty($newsListNode)){
      // Methode avec l'url
      $listUrl = $newsListNode->toUrl();
      $link[] = Link::fromTextAndUrl($newsListNode->label(), $listUrl);

      // Methode avec la route
      $link[] = Link::createFromRoute($newsListNode->label(), 'entity.node.canonical', ['node'=>$newsListNode->id()]);
    }

    // EXEMPLE DE NO-LINK
    $link[] = Link::createFromRoute(t('nolink'), '<nolink>');
    $link[] = Link::createFromRoute(t('none'), '<none>');

    // LA PAGE EN COURS
    $nodeEntity = $route_match->getParameter('node');
    $langId = $this->languageManager->getCurrentLanguage()->getId();
    if($nodeEntity->hasTranslation($langId)){
      $nodeEntityTrans = $nodeEntity->getTranslation($langId);
    }
    $title = $nodeEntityTrans->label();
    $link[] = Link::createFromRoute(t($title), '<none>');

    /**
     * La page en cours 2eme technique
     * @var \Drupal\Core\Controller\TitleResolver
     */
    $title = $this->titleResolver->getTitle($this->requestStack->getCurrentRequest(), $route_match->getRouteObject());
//    $title = $titleResolver->getTitle(\Drupal::request(), $route_match->getRouteObject());
    $link[] = Link::createFromRoute(t($title), '<none>');

    // RETURN BREADCRUMB
//    return $titlePageDeList;
    return $this->breadcrumb->setLinks($link);
  }

}
