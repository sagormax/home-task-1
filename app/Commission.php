<?php

namespace TrxCommission;

class Commission extends Utility
{
      use Helper;

      private $EURate;
      private $nonEURate;
      private $transactionPayload;

      /**
       * Commission constructor.
       *
       * @param array $payload
       */
      public function __construct(Array $payload)
      {
            $this->transactionPayload = $payload;
      }

      /**
       * EU rate setter
       *
       * @param $rate
       */
      public function setEURate($rate)
      {
            $this->EURate = $rate;
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
       * @param $json
       * @return mixed
       * @throws \Exception
       */
      public function generateCommission($json)
      {
            if(
                !array_key_exists('currency', $this->transactionPayload) ||
                !array_key_exists('amount', $this->transactionPayload)
            ) {
                  throw new \Exception('Invalid transaction payload');
            }

            $rate       = $this->getRateByCurrency($this->transactionPayload['currency']);
            $amount     = $this->generateAmount($rate);
            $country    = $this->getCountries($json);
            $bins       = json_decode($this->getBin($this->transactionPayload));

            $commission = $amount * ($country->isEU($bins->country->alpha2) ? $this->EURate : $this->nonEURate);

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