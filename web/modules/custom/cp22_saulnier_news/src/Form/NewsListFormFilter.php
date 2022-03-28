<?php
namespace Drupal\cp22_saulnier_news\Form;

use Drupal;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\cp22_saulnier_news\Manager\NewsManagerTaxoInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 *  This class is used inside the newslist Filter form
 *  Used for a date sort
 */
class NewsListFormFilter extends FormBase {


  protected $requestStack;

  public function __construct(RequestStack $requestStack)
  {
    $this->requestStack = $requestStack;
  }

  /** C'est l'identifiant du formulaire */
  public function getFormId()
  {
    return 'news_list_form_filter';
  }

  /** Ca construit le formulaire */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['news_taxo_form_filter'] = [
        '#type' => 'select',
        '#title' => $this->t('Trier par date'),
        '#options' => [
          '1' => $this ->t('Croissant'),
          '2' => $this ->t('Décroissant')
        ]
    ];

    $form['submit'] = [
      '#type' =>  'submit',
      '#value'  =>  $this->t('Filtrer')
    ];

    return $form;
  }

  public static function create(ContainerInterface $container){
    return new static(
      $container->get('request_stack')
    );
  }

  /** Cette methode permet de mettre une action lors de la validation du formulaire */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {

    // On recupere les valeurs dans formulaire
    $value = $form_state->getValue('news_taxo_form_filter');


    // C'est un service de stack de requete qui permet de recuperer ce qu'il y a dans l'url
    // get Current request permet d'obtenir la requete en cours
    // query pour la query string ( la valeur dans l'url)
    // set permet d'editer sa valeur
    $requete = $this->requestStack->getCurrentRequest()->query->set('news_taxo_form_filter',$value);
  }

}
