<?php

namespace App\Helper;
use Illuminate\Support\Facades\Http;

class CurrencyHelper {

    public static function changeCurrency($value) {
        // dd($value);

        $response = Http::get('https://open.er-api.com/v6/latest/USD');
        
        // Check if the request was successful
        if ($response->successful()) {
            // Parse the JSON response
            $data = $response->json();

            // Check if the rates data is available
            if (isset($data['rates']['INR'])) {
                // Get the exchange rate for USD to INR
                $conversionRate = $data['rates']['INR'];

                // Convert USD amount to INR
                $inrAmount = $value * $conversionRate;
                // dd($inrAmount);
                return $inrAmount;
            } else {
                // Handle if exchange rate for INR is not available
                return null;
            }
        } else {
            // Handle if API request failed
            return null;
        }
    }

}