<?php

use \TrxCommission\Helper;
use \TrxCommission\Utility;
use \TrxCommission\Country;
use \TrxCommission\Commission;
use \PHPUnit\Framework\TestCase;
use \TrxCommission\CurrencyRate;

class UtilityTest extends TestCase
{
      use Helper;

      public function test_check_commission()
      {
            $commission = new Commission(["bin" => "516793","amount" => "50.00","currency" => "USD"]);
            $commission->setEURate(0.01);
            $commission->setNonEURate(0.02);

            $amount = $commission->generateCommission($commission->getRemoteData(__DIR__ . '/../../eu.json'));

            $this->assertEquals($amount, 0.46);
      }

      public function test_currency_rate()
      {
            $utility    = new Utility();
            $rate       = $utility->getRateByCurrency('USD');
            $this->assertEquals($rate, 1.0871);
      }

      public function test_check_currency_rate_class()
      {
            $utility          = new Utility();
            $currencyRate     = $utility->getCurrencyRate($utility::CURRENCY_RATE_ENDPOINT);

            $this->assertInstanceOf(CurrencyRate::class, $currencyRate);
      }

      public function test_check_currency_rate_array_keys()
      {
            $utility          = new Utility();
            $currencyRate     = json_decode(
                $utility->getCurrencyRate($utility::CURRENCY_RATE_ENDPOINT)->getRate(),
                true
            );

            $this->assertArrayHasKey('rates', $currencyRate);
      }

      public function test_is_eu_country()
      {
            $countries  = json_decode($this->getRemoteData(__DIR__ . '/../../eu.json'), true);
            $country    = new Country($countries);

            $this->assertEquals($country->isEU('abc'), false);
            $this->assertEquals($country->isEU('cy'), true);
      }
}