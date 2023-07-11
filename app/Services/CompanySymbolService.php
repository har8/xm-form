<?php
namespace App\Services;

use App\Contracts\CompanySymbolServiceInterface;
use Illuminate\Support\Facades\Http;
  
class CompanySymbolService implements CompanySymbolServiceInterface
{

    public function fetchData(string $url) 
    {
		$response = Http::get($url);
    
        if ($response->successful()) {
            return $response->json();
        }

    	throw new \Exception('Ooops!! Failed to fetch data from Nasdaq.');
    }
}