<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;

use App\Mail\CompanyDataEmail;
use App\Http\Requests\HistoricalQuotesRequest;
use App\Contracts\HistoricalDataServiceInterface;


class FormController extends Controller
{
    private $symbolData;

    public function __construct()
    {
        $this->symbolData = Cache::remember('symbolData', 60 * 60, function () {
            return collect($this->fetchSymbolData());
        });
    }

    public function create()
    {
        
        return view('form')->with('symbolData', $this->symbolData);
    }

    public function store(HistoricalQuotesRequest $request, HistoricalDataServiceInterface $historicalDataService)
    {
        // Retrieve company name from the symbol using the cache
        $companyName = $this->symbolData->firstWhere('Symbol', $request->company_symbol)['Company Name'];
		
		$startDate = $request->input('start_date');
		$endDate = $request->input('end_date');
		$email = $request->input('email');
		
		$config = [
			'url' => env('X_RAPIDAPI_URL'),
			'key' => env('X_RAPIDAPI_KEY'),
			'host' => env('X_RAPIDAPI_HOST')
		];

		try{
			$response = $historicalDataService->fetchData($config, $request->company_symbol);
			if ($response->successful()) {
				// Parse the API response and extract the historical data
				$historicalData = $response->json()['prices'];

				//TODO: move to Mail Facade.
				Mail::to($email)->send(new CompanyDataEmail([
					'companyName' => $companyName,
					'startDate' => $startDate,
					'endDate' => $endDate,
				]));
		
				return view('result', compact('historicalData', 'companyName', 'startDate', 'endDate'));	
			}else{
				throw new \Exception('Oops!! Service is unavailable, please try again later.');
			}			
		} catch (\Exception $e) {
			$errorMessage = $e->getMessage();
			return Redirect::back()->with('warning', $errorMessage)->withInput();
		}
    }

    private function fetchSymbolData()
    {
		//TODO: move to Symbol Service.
        $response = Http::get('https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json');
    
        if ($response->successful()) {
            return $response->json();
        }

    	throw new \Exception('Ooops!! Failed to fetch data from Nasdaq.');
    }
   
}
