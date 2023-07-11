<?php

namespace App\Contracts;
  
Interface HistoricalDataServiceInterface
{
    public function fetchData($credentials);
}