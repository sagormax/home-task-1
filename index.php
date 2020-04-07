<?php

require_once __DIR__. '/vendor/autoload.php';

use TrxCommission\Commission;
$application = new Commission(['bin' => 45717360]);

var_dump($application->getBin());
