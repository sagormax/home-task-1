<?php


namespace TrxCommission;


trait Helper
{
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