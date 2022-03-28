<?php

namespace Drupal\cp22_saulnier_news\Manager;

use Drupal\Core\Datetime\DrupalDateTime;

/**
 * NewsListService dates Manager.
 */
class DatesManager {

  function checkActualDate(): int{
    $dateNew = new DrupalDateTime();
    $timestampNew = strtotime($dateNew);
    return $timestampNew;
  }

  function transformDateToCalculate($date): int{
//    format date '2022-01-24 09:59:00';
    $timestampPerso = strtotime($date);
    return $date;
  }

  function calculateDateSpendUntilToday($date){
    $now = $this->checkActualDate();
    $dateToCalcul = $this->transformDateToCalculate($date);

    $spendTime = $now - $dateToCalcul;
    return $spendTime;
  }

  function getTimeSpend(){
    $date = '2022-01-24 09:59:00';
    $timeStampGone = $this->calculateDateSpendUntilToday($date);
    $timeGone = date('m/d/Y H:i:s', $timeStampGone);

    return [$timeGone, $timeStampGone];
  }




}
