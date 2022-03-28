<?php

namespace Drupal\cp22_saulnier_testUnitaire\Gateway;

class CurrencyGateway implements CurrencyGatewayInterface{


//   protected $currencyEURDOL = 1.05;
//   protected $currencyJPYDOL = 1.55;
//   protected $currencyZARDOL = 6.9;

//   protected $bankcost = [
//     0      => 10,
//     1000   => 5,
//     5000   => 3.5,
//     10000   => 2
//   ] ;

   protected $json =
     '{
        "changes": [
          {
            "currency": "EUR",
            "rate": 1.05
          },
          {
            "currency": "JPY",
            "rate": 1.55
          },
          {
            "currency": "ZAR",
            "rate": 6.9
          }
        ],
        "cost": {
          "0": 10.0,
          "1000": 5.0,
          "5000": 3.5,
          "10000": 2.0
        }
      }';

  public function dataLayerJson(){
    return json_decode($this->json, true);
  }

  public function fetchCurrencyEUR(){
    $currency = $this->dataLayerJson();
    return $currency['changes'][0]['rate'];

  }

  public function fetchCurrencyJPY(){
    $currency = $this->dataLayerJson();
    return $currency['changes'][1]['rate'];
  }

  public function fetchCurrencyZAR(){
    $currency = $this->dataLayerJson();
    return $currency['changes'][2]['rate'];
  }

  public function fetchBankCost(){
    $currency = $this->dataLayerJson();
    return $currency['cost'];
  }



}
