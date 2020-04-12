<?php

require_once __DIR__. '/vendor/autoload.php';

use TrxCommission\Commission;

const EU_RATE     = 0.01;
const NON_EU_RATE = 0.02;

// Getting json content from input.txt file
foreach (explode("\n", file_get_contents($argv[1])) as $row) {
      if (empty($row)) break;
      $payload    = json_decode($row, true);
      $commission = new Commission($payload);
      $commission->setEuRate(EU_RATE);
      $commission->setNonEURate(NON_EU_RATE);

      try {
            echo $commission->generateCommission($commission->getRemoteData(__DIR__ . '/eu.json'));
      } catch (Exception $e) {
            echo $e->getMessage() . "\n";
            continue;
      }

      print "\n";
}
