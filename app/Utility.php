<?php


namespace TrxCommission;


class Utility
{
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
       * Get remote data form a URL
       *
       * @param string $url
       * @return false|string
       */
      public function getRemoteData($url = '')
      {
            return file_get_contents($url);
      }
}