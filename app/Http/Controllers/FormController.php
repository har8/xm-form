<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyDataEmail;

class FormController extends Controller
{
    public function create()
    {
        $symbolData = $this->fetchSymbolData();

        return view('form', compact('symbolData'));
    }

    public function store(Request $request)
    {
        // Validate the form inputs
        $validator = Validator::make($request->all(), [
            'symbol' => 'required',
            'start_date' => 'required|date|before_or_equal:end_date|before_or_equal:' . now()->format('Y-m-d'),
            'end_date' => 'required|date|after_or_equal:start_date|before_or_equal:' . now()->format('Y-m-d'),
            'email' => 'required|email',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Retrieve company name from the symbol using the provided JSON file
        $symbolsJson = Http::get('https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json');
        $symbolsData = $symbolsJson->json();
        $symbol = strtoupper($request->input('symbol'));
        $companyName = '';
        foreach ($symbolsData as $symbolData) {
            if ($symbolData['Symbol'] === $symbol) {
                $companyName = $symbolData['Company Name'];
                break;
            }
        }

        // Fetch historical data using the provided API
        $apiUrl = 'https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data';
        $response = Http::withHeaders([
            'X-RapidAPI-Key' => env('X-RapidAPI-Key'),
            'X-RapidAPI-Host' => env('X-RapidAPI-Host'),
        ])->get($apiUrl, [
            'symbol' => $symbol,
            'region' => 'US',
        ]);

        // Parse the API response and extract the historical data
        $historicalData = $response->json()['historical'];

        // Send the email
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $email = $request->input('email');
        Mail::to($email)->send(new CompanyDataEmail($companyName, $startDate, $endDate));

        // Return the response or redirect to the appropriate view
        return view('result', compact('historicalData', 'companyName', 'startDate', 'endDate'));
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
