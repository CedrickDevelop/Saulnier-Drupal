<?php
namespace Drupal\cp22_saulnier_news\Form;

use Drupal;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\cp22_saulnier_news\Manager\NewsManagerTaxoInterface;
use Drupal\cp22_saulnier_news\Manager\NewsTermsManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 *  This class is used inside the newslist Filter form
 *  Used for a theme sort
 */
class NewsListForm extends FormBase {


  /**
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;


  /**
   * @var \Drupal\cp22_saulnier_news\Manager\NewsTermsManager
   */
  protected $newsTermManager;

  public function __construct(
    NewsTermsManager $newsTermsManager,
    RequestStack $requestStack)
  {
    $this->newsTermManager = $newsTermsManager;
    $this->requestStack = $requestStack;
  }

  /** C'est l'identifiant du formulaire */
  public function getFormId()
  {
    return 'news_list_form';
  }

  /** Ca construit le formulaire */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['news_taxo_form'] = [
        '#type' => 'select',
        '#title' => $this->t('Filtrer par :'),
        '#options' => $this->newsTermManager->getbuiltTerms(),
        '#empty_option'  => 'thème',
        '#default_value'  => $this->requestStack->getCurrentRequest()->query->get('news_taxo_form'),
        '#attributes' => array('onchange' => 'this.form.submit();'),
    ];

    $form['news_taxo_form_date'] = [
        '#type' => 'select',
        '#title' => $this->t('Trier par :'),
        '#options' => [
          'ASC' => 'Date chronologique',
          'DESC' => 'Date antéchronologique'
        ],
        '#empty_option'  => 'date de publication',
        '#default_value'  => $this->requestStack->getCurrentRequest()->query->get('news_taxo_form_date'),
        '#attributes' => array('onchange' => 'this.form.submit();'),
    ];


//    $form['submit'] = [
//      '#type' =>  'submit',
//      '#value'  =>  $this->t('Envoyer')
//    ];

    return $form;
  }

  public static function create(ContainerInterface $container){
    $newsTermsManager = $container->get(NewsTermsManager::SERVICE_NAME);

    return new static(
      $newsTermsManager,
      $container->get('request_stack')
    );
  }

  /** Cette methode permet de mettre une action lors de la validation du formulaire */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {

    // On recupere les valeurs dans formulaire
    $theme = $form_state->getValue('news_taxo_form');
    $date = $form_state->getValue('news_taxo_form_date');

    // C'est un service de stack de requete qui permet de recuperer ce qu'il y a dans l'url
    // get Current request permet d'obtenir la requete en cours
    // query pour la query string ( la valeur dans l'url)
    // set permet d'editer sa valeur
    $this->requestStack->getCurrentRequest()->query->set('news_taxo_form',$theme);
    $this->requestStack->getCurrentRequest()->query->set('news_taxo_form_date',$date);

  }

  /** Cette methode permet de mettre des conditions à la validité du formulaire */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    parent::validateForm($form, $form_state);

  }
}
