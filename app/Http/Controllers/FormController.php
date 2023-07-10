<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use App\Mail\CompanyDataEmail;


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

    public function store(Request $request)
    {
        // Validate the form inputs
        $validator = Validator::make($request->all(), [
            'company_symbol' => 'required',
            'start_date' => 'required|date|before_or_equal:end_date|before_or_equal:' . now()->format('Y-m-d'),
            'end_date' => 'required|date|after_or_equal:start_date|before_or_equal:' . now()->format('Y-m-d'),
            'email' => 'required|email',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Retrieve company name from the symbol using the cache
        $companyName = $this->symbolData->firstWhere('Symbol', $request->company_symbol)['Company Name'];

		try{
			$apiUrl = 'https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data';
			$response = Http::withHeaders([
				'X-RapidAPI-Key' => $_ENV['X_RAPIDAPI_KEY'],
				'X-RapidAPI-Host' => $_ENV['X_RAPIDAPI_HOST'],
			])->get($apiUrl, [
				'symbol' => $request->company_symbol
			]);
			
			if ($response->successful()) {
				// Parse the API response and extract the historical data
				$historicalData = $response->json()['prices'];

				// Send the email
				$startDate = $request->input('start_date');
				$endDate = $request->input('end_date');
				$email = $request->input('email');
		/*        
				Mail::to($email)->send(new CompanyDataEmail([
					'companyName' => $companyName,
					'startDate' => $startDate,
					'endDate' => $endDate,
				]));
		*/
				return view('result', compact('historicalData', 'companyName', 'startDate', 'endDate'));	
			}else{
				throw new \Exception('Oops!! Service is unavailable, please try again later.');
			}
	dd($response);
			
		} catch (\Exception $e) {
			$errorMessage = $e->getMessage();
			return Redirect::back()->with('warning', $errorMessage)->withInput();
		}
    }

    private function fetchSymbolData()
    {
        $response = Http::get('https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json');
    
        if ($response->successful()) {
            return $response->json();
        }
    
        return [];
    }
   
}
