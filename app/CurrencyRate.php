<?php


namespace TrxCommission;


use TrxCommission\contracts\Rateable;

class CurrencyRate implements Rateable
{
      use Helper;

      private $url;

      /**
       * CurrencyRate constructor.
       *
       * @param $url
       */
      public function __construct($url)
      {
            $this->url = $url;
      }

      /**
       * Get rate
       *
       * @return false|string
       */
      public function getRate()
      {
            return $this->getRemoteData($this->url);
      }
}