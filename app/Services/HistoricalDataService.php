<?php
namespace App\Services;

use App\Contracts\HistoricalDataServiceInterface;
use Illuminate\Support\Facades\Http;
  
class HistoricalDataService implements HistoricalDataServiceInterface
{

    public function fetchData(string $symbol) 
    {
			return Http::withHeaders([
				'X-RapidAPI-Key' => env('X_RAPIDAPI_KEY'),
				'X-RapidAPI-Host' => env('X_RAPIDAPI_HOST'),
				])->get(env('X_RAPIDAPI_URL'), [
					'symbol' => $symbol
				]);
    }
}