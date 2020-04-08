<?php


namespace TrxCommission;


class Country
{
      private $countries;

      /**
       * Country constructor.
       *
       * @param array $countries
       */
      public function __construct(Array $countries)
      {
            $this->countries = $countries;
      }

      /**
       * Country getter
       *
       * @return array
       */
      public function getCountries()
      {
            return $this->countries;
      }

      /**
       * Is that country is EU enlisted
       *
       * @param $country
       * @return bool
       */
      public function isEU($country)
      {
            return in_array(strtoupper($country), $this->countries);
      }
}