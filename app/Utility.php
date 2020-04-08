<?php


namespace TrxCommission;


class Utility
{
      use Helper;

      const BIN_LIST_ENDPOINT = 'https://lookup.binlist.net/';
      const CURRENCY_RATE_ENDPOINT = 'https://api.exchangeratesapi.io/latest';

      /**
       * Get countries code
       *
       * @param $json
       * @return Country
       */
      public function getCountries($json)
      {
            return new Country(json_decode($json, true));
      }

      /**
       * Get Currency Rate
       *
       * @param $currency
       * @return mixed
       * @throws \Exception
       */
      public function getRateByCurrency($currency)
      {
            $currencyRate = json_decode(
                $this->getCurrencyRate(self::CURRENCY_RATE_ENDPOINT)->getRate(),
                true
            );

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

      /**
       * Get Currency Rate
       *
       * @param $url
       * @return false|string
       */
      public function getCurrencyRate($url)
      {
            return new CurrencyRate($url);
      }
}