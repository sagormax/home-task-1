<?php


namespace TrxCommission;


abstract class Utility
{
      use Helper;

      const BIN_LIST_ENDPOINT = 'https://lookup.binlist.net/';

      /**
       * Get Currency Rate
       *
       * @param $currency
       * @param $currencyRate
       * @return mixed
       * @throws \Exception
       */
      public function getRateByCurrency($currency, $currencyRate)
      {
            if( ! array_key_exists('rates', $currencyRate) ) {
                  throw new \Exception('Invalid currency rate');
            }

            $rate = $currencyRate['rates'];
            if( array_key_exists(strtoupper($currency), $rate) ) {
                  return $rate[strtoupper($currency)];
            }

            throw new \Exception('Invalid currency that is not listed.');
      }

      /**
       * Get BIN result from a remote url
       *
       * @param $payload
       * @return false|string
       * @throws \Exception
       */
      public function getBin($payload)
      {
            if( array_key_exists('bin', $payload) ) {
                  return $this->getRemoteData(self::BIN_LIST_ENDPOINT . $payload['bin']);
            }

            throw new \Exception('Invalid payload for getting BIN result.');
      }
}