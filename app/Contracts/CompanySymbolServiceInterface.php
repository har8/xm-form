<?php

namespace App\Contracts;
  
Interface CompanySymbolServiceInterface
{
    public function fetchData(string $url);
}