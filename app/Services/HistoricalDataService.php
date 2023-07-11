<?php
namespace App\Services;

use App\Contracts\HistoricalDataServiceInterface;
use Illuminate\Support\Facades\Http;
  
class HistoricalDataService implements HistoricalDataServiceInterface
{

    public function fetchData(array $config, string $symbol) 
    {
			return Http::withHeaders([
				'X-RapidAPI-Key' => $config['key'],
				'X-RapidAPI-Host' => $config['host'],
				])->get($config['url'], [
					'symbol' => $symbol
				]);
    }
}