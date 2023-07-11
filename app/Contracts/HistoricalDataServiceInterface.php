<?php

namespace App\Contracts;
  
Interface HistoricalDataServiceInterface
{
    public function fetchData(array $config, string $symbol);
}