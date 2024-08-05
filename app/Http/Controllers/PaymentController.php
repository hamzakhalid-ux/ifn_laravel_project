<?php

namespace App\Http\Controllers;

use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
use Illuminate\Http\Request;
use IPay88\Requests\RequestBuilder as IPay88RequestBuilder;
use IPay88\Responses\Response as IPay88Response;
use App\Services\ExchangeRatesService;
use Exception;

class PaymentController extends Controller
{
    //
    public function redirectToPaymentGateway()
    {
        $builder = new IPay88RequestBuilder();
        $builder->setRefNo(1);
        $builder->setAmount(1);
        $builder->setCurrency('MYR');
        $builder->setProdDesc('Sample Prod Desc');
        $builder->setUserName('Sample User Name');
        $builder->setUserEmail('hk130563@gmail.com');
        $builder->setUserContact('Sample User Contact');
        $builder->setResponseURL(url('/payment/response'));
        $builder->setBackendURL(url('/payment/response'));

    return $builder->loadPaymentFormView();
    }

    public function handlePaymentResponse(Request $request)
    {
        dd($request->all());
        $response = new IPay88Response($request->all(),false);

        // Handle the payment response
        // Update order status, send email, etc.
        dd($response);
        if($response->isSuccess()){
            // update order to PAID
             return "RECEIVE OK";
        }else{
            // update order to FAIL
            return "FAILED";

        }

        return view('payment.response', compact('response'));
    }
    public function exchangeRates()
    {
        $access_key =env('EXCHANGE_RATES_API_KEY');
        $apiEndpoint = "https://api.exchangeratesapi.io/v1/convert?access_key=$access_key&from=USD&to=PKR&amount=1";
        // Initialize cURL session
        $ch = curl_init();
        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $apiEndpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // Execute cURL session and fetch the response
        $response = curl_exec($ch);
        // Check for cURL errors
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }
        // Close cURL session
        curl_close($ch);
        // Process the response
            if ($response) {
                // Decode JSON response if applicable
                $responseData = json_decode($response);

                // Handle the data as needed
                // ...
                dd($responseData);
            } else {
                echo 'No response received.';
            }

    }

    public function exchangeAmount($from_curr,$to_curr,$amount)
    {
        try{

            $access_key =env('EXCHANGE_RATES_API_KEY');
            $apiEndpoint = "https://api.exchangeratesapi.io/v1/convert?access_key=$access_key&from=$from_curr&to=$to_curr&amount=$amount";
            // Initialize cURL session
            $ch = curl_init();
            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, $apiEndpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // Execute cURL session and fetch the response
            $response = curl_exec($ch);
            // Check for cURL errors
            if (curl_errno($ch)) {
                echo 'Curl error: ' . curl_error($ch);
            }
            // Close cURL session
            curl_close($ch);
            // Process the response
                if ($response) {
                    // Decode JSON response if applicable
                    $responseData = json_decode($response);
                    return  $responseData->result ?? '';
                } else {
                    return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);
                }

        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);
        }
    }

}
