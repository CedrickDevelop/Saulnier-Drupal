<?php

namespace Drupal\Tests\cp22_saulnier_testUnitaire\Unit\Manager;

use Drupal\cp22_saulnier_testUnitaire\Gateway\CurrencyGateway;
use Drupal\cp22_saulnier_testUnitaire\Manager\CurrencyManager;
use Drupal\Tests\UnitTestCase;

class UnitTestCurrencyManagerTest extends UnitTestCase {


  /**
   *
   */
//  public function testCurrency(){
//    $this->assertTrue(true);
//  }

  //**************** TESTS DE LA GATEWAY ********************
  public function testCurrencyEURGateway(){
    $currencyEUR = new CurrencyGateway();
    $currency = $currencyEUR->fetchCurrencyEUR();

    $this->assertSame($currency, 1.05);
  }

  public function testCurrencyJPYGateway(){
    $currencyJPY = new CurrencyGateway();
    $currency = $currencyJPY->fetchCurrencyJPY();

    $this->assertSame($currency, 1.55);
  }

  public function testCurrencyZARGateway(){
    $currencyZAR = new CurrencyGateway();
    $currency = $currencyZAR->fetchCurrencyZAR();

    $this->assertSame($currency, 6.9);
  }

  //**************** TESTS DE LA GATEWAY SUR JSON DATA ********************

  public function testDataJsonAssociativeChangesGateway(){
    $fetchData = new CurrencyGateway();
    $dataLayer = $fetchData->dataLayerJson();

    $this->assertIsArray($dataLayer);
    $this->assertIsArray($dataLayer['changes']);

    $this->assertIsArray($dataLayer['changes'][0]);

    $this->assertIsString($dataLayer['changes'][0]['currency']);
    $this->assertIsFloat($dataLayer['changes'][0]['rate']);

  }

  public function testDataJsonAssociativeCostsGateway(){
    $fetchData = new CurrencyGateway();
    $dataLayer = $fetchData->dataLayerJson();

    // Verify that the data are in an asociative array
    $this->assertIsArray($dataLayer);
    $this->assertIsArray($dataLayer['cost']);

    $bankCosts = $dataLayer['cost'];
    $bankAmountCost = [0,1000,5000,10000];

    // Verify that the key for bank fee step are ok
    foreach ($bankAmountCost as $cost){
      $this->assertArrayHasKey($cost, $bankCosts);
    }
  }

  //**************** TESTS DU MANAGER ********************

  public function testBankCostOnManager(){
      $currencyManager = new CurrencyManager(new CurrencyGateway());
      $bankCostsFromGateway = $currencyManager->getBankCostFromGateway();

      //Verify if the cost are on float value
      foreach ($bankCostsFromGateway as $bankCost){
        $this->assertIsFloat($bankCost);
      }

      $bankCostManager = $currencyManager->setBankCost(1000);
      $this->assertIsFloat($bankCostManager);

  }

  //**************** TESTS DE LA GATEWAY SUR TABLEAU ********************

//  public function testBankCostKeyGateway(){
//    $fetchBankCost = new CurrencyGateway();
//    $bankCost = $fetchBankCost->fetchBankCost();
//    $bankAmountCostKey = [0,1000,5000,10000];
//
//    $this->assertIsArray($bankCost);
//
//    foreach ($bankAmountCostKey as $key){
//      $this->assertArrayHasKey($key,$bankCost,"There are no" .$key. " amount");
//    }
//
//  }
}
