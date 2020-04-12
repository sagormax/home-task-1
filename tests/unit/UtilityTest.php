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

      const BIN_LIST_ENDPOINT = 'https://lookup.binlist.net/';
      const CURRENCY_RATE_ENDPOINT = 'https://api.exchangeratesapi.io/latest';

      protected $rate;
      protected $countries;

      public function setUp(): void
      {
            $this->rate       = new CurrencyRate(self::CURRENCY_RATE_ENDPOINT);
            $this->countries  = new Country(json_decode($this->getRemoteData(__DIR__ . '/../../eu.json')));
      }

      /** @test
       * @throws Exception
       */
      public function check_commission_for_eu_countries()
      {
            $payload          = ["bin" => "516793","amount" => "50.00","currency" => "USD"];
            $commission       = new Commission($payload, $this->rate, $this->countries);

            $commission->setEuRate(0.01);

            $amount = $commission->generate();

            $this->assertEquals($amount, 0.46);
      }

      /** @test
       * @throws Exception
       */
      public function check_commission_for_non_eu_countries()
      {
            $payload          = ["bin" => "45417360","amount" => "10000.00","currency" => "JPY"];
            $commission       = new Commission($payload, $this->rate, $this->countries);

            $commission->setNonEURate(0.02);

            $amount = $commission->generate();

            $this->assertEquals($amount, 1.69);
      }
}