<?php

namespace Drupal\cp22_saulnier_testUnitaire\Manager;

use Drupal\cp22_saulnier_testUnitaire\Gateway\CurrencyGatewayInterface;

class CurrencyManager {

  /**
   * @var \Drupal\cp22_saulnier_testUnitaire\Gateway\CurrencyGatewayInterface
   */
  protected $currencyGateway;

  public function __construct(
    CurrencyGatewayInterface $currencyGateway)
  {
    $this->currencyGateway = $currencyGateway;
  }


  public function getCurrencyInDollar($currency){
    $currency_cost = "";

    if ($currency === 'EUR'){
      $currency_cost = $this->currencyGateway->fetchCurrencyEUR();
    }

    if ($currency === 'JPY'){
      $currency_cost = $this->currencyGateway->fetchCurrencyJPY();
    }

    if ($currency === 'ZAR'){
      $currency_cost = $this->currencyGateway->fetchCurrencyZAR();
    }

    return $currency_cost;
  }

  public function getBankCostFromGateway(){
    return $this->currencyGateway->fetchBankCost();
  }

  public function setBankCost($amount)
  {
    $bankCost = 2.3;
    $bankCostArray = $this->getBankCostFromGateway();

      if($amount > array_keys($bankCostArray)){
        $bankCost = $bankCostArray;
      }


    return $bankCost;

  }

  public function setAmountToChangeWithCurrencyInDollar($amount, $currency){
    $bank_cost = $this->getBankCost($amount);
    $rest_amount = $amount - $bank_cost;
    return $rest_amount * $this->getCurrencyInDollar($currency);
  }


}
