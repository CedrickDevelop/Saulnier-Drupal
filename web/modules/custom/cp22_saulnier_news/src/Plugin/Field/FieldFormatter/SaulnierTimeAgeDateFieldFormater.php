<?php


namespace Drupal\cp22_saulnier_news\Plugin\Field\FieldFormatter;

use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'Time ago' formatter for 'datetime' fields.
 *
 * @FieldFormatter(
 *   id = "saulnier_datetime_time_ago",
 *   label = @Translation("saulnier Time ago"),
 *   field_types = {
 *     "datetime"
 *   }
 * )
 */
  class SaulnierTimeAgeDateFieldFormater extends FormatterBase {

    /**
     * @param FieldItemListInterface $items
     * @param $langcode
     */
    public function viewElements(FieldItemListInterface $items, $langcode)
    {
      $elements = [];


      $dateNew = new DrupalDateTime();
      $timestampNew = strtotime($dateNew);

      $timePerso = '2022-01-24 09:59:00';
      $timestampPerso = strtotime($timePerso);

      $duree = $timestampNew - $timestampPerso;

      $dureeShow = round($duree / 3600 / 24);

      $show = '';
      if ($dureeShow > 1) {
        $show = "Il y a ". $dureeShow. "jours";
      } else {
        $dureeShow = round($duree / 3600);
        $show = "aujourd'hui, il y a ". $dureeShow ."heures";
      }


      $node = $items->getEntity();
//      var_dump($node);exit;

      foreach ($items as $delta => $item) {

          $updated = [
            '#markup' => $show,
          ];
          $elements[$delta] = $updated;
      }


      return $elements;
    }
    //////////////////////////////////////////////////////////////////
    /// Correction
    /// //////////////////////////////////::::::::::::::::::::::::::::::::
    ///$elements = [];
    //    $ago = '';
    //    foreach ($items as $delta => $item) {
    //      /** @var \Drupal\Core\Datetime\DrupalDateTime $date */
    //      $date = $item->date;
    //      $now = new \DateTime("now");
    //      $ago = $date->diff($now);
    ////      dd($ago);
    ////      $ago->d = 3; // Juste pour tester les valeurs
    //      // if date is today
    //      if ($ago->d == 0) {
    //        $output = [
    //          '#markup' => 'Il y a ' . $ago->format('%i') . ' minutes'
    //        ];
    //      }
    //      // if date is yesterday
    //      if ($ago->d == 1) {
    //        $output = [
    //          '#markup' => 'Publié hier'
    //        ];
    //      }
    //      // if date is older than yesterday
    //      if ($ago->d >= 2) {
    //        $output = [
    //          '#markup' => 'Il y a ' . $ago->format('%a') . ' jours',
    //        ];
    //      }
    //      $elements[$delta] = $output;
    //    }
    //    return $elements;

  }
