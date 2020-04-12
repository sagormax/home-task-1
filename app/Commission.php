<?php

namespace TrxCommission;

use TrxCommission\contracts\Commissionable;
use TrxCommission\contracts\Rateable;

class Commission extends Utility implements Commissionable
{
      use Helper;

      private $euRate;
      private $nonEURate;
      private $countries;
      private $currencyRate;
      private $transactionPayload;

      /**
       * Commission constructor.
       *
       * @param array $payload
       * @param Rateable $rateable
       * @param Country $countries
       */
      public function __construct(Array $payload, Rateable $rateable, Country $countries)
      {
            $this->currencyRate           = $rateable;
            $this->countries              = $countries;
            $this->transactionPayload     = $payload;
      }

      /**
       * EU rate setter
       *
       * @param $rate
       */
      public function setEuRate($rate)
      {
            $this->euRate = $rate;
      }

      /**
       * Non EU rate setter
       *
       * @param $rate
       */
      public function setNonEURate($rate)
      {
            $this->nonEURate = $rate;
      }

      /**
       * Generate Commission
       *
       * @return mixed
       * @throws \Exception
       */
      public function generate()
      {
            if(
                !array_key_exists('currency', $this->transactionPayload) ||
                !array_key_exists('amount', $this->transactionPayload)
            ) {
                  throw new \Exception('Invalid transaction payload');
            }

            $rate       = $this->getRateByCurrency(
                $this->transactionPayload['currency'],
                json_decode($this->currencyRate->getRate(), true)
            );

            $amount     = $this->generateAmount($rate);
            $bins       = json_decode($this->getBin($this->transactionPayload));

            $commission = $amount * ($this->countries->isEU($bins->country->alpha2) ? $this->euRate : $this->nonEURate);

            // As an improvement, it should ceil commissions by cents.
            // For example, 0.46180... should become 0.47
            return number_format($commission, 2);
      }

      /**
       * Generate Amount
       *
       * @param $rate
       * @return float|int
       */
      public function generateAmount($rate)
      {
            $amount = $this->transactionPayload['amount'];

            if( strtoupper($this->transactionPayload['currency']) !== 'EU' || $rate > 0) {
                  $amount = $amount / $rate;
            }

            return $amount;
      }
}