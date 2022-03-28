<?php

namespace Drupal\cp22_saulnier_testUnitaire\Gateway;

interface CurrencyGatewayInterface {


  public function fetchCurrencyEUR();

  public function fetchCurrencyJPY();

  public function fetchCurrencyZAR();

  public function fetchBankCost();
}
