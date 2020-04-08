<?php


namespace TrxCommission\contracts;


interface Commissionable
{
      public function setEURate($rate);

      public function setNonEURate($rate);

      public function generateCommission($json);
}