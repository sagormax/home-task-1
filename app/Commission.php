<?php
namespace TrxCommission;

class Commission
{
      const BIN_LIST_ENDPOINT = 'https://lookup.binlist.net/';

      private $cardBin;
      private $commissionRate;
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
       * Get BIN result from a remote url
       *
       * @return false|string
       * @throws \Exception
       */
      public function getBin()
      {
            if( array_key_exists('bin', $this->transactionPayload) ) {
                  return $this->getRemoteData(self::BIN_LIST_ENDPOINT . $this->transactionPayload['bin']);
            }

            throw new \Exception('Invalid payload for getting BIN result.');
      }

      /**
       * Get remote data form a URL
       *
       * @param string $url
       * @return false|string
       */
      private function getRemoteData($url = '')
      {
            return file_get_contents($url);
      }
}