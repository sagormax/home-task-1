<?php


namespace TrxCommission\contracts;


interface Commissionable
{
      public function setEuRate($rate);

      public function setNonEURate($rate);

      public function generate();
}