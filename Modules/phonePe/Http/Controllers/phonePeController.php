<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class PhonePeController extends Controller
{
    public function phonePe()
    {
        // Construct the payment request data for PhonePe
        $data = [
            'merchantId' => 'MERCHANTUAT',
            'merchantTransactionId' => uniqid(),
            'merchantUserId' => 'MUID123',
            'amount' => 10000,
            'redirectUrl' => route('response'), // Replace with your callback URL
            'redirectMode' => 'POST',
            'callbackUrl' => route('response'), // Replace with your callback URL
            'mobileNumber' => '9999999999',
            'paymentInstrument' => [
                'type' => 'PAY_PAGE',
            ],
        ];

        $encode = base64_encode(json_encode($data));

        // PhonePe-specific salt and key
        $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
        $saltIndex = 1;

        $string = $encode . '/pg/v1/pay' . $saltKey;
        $sha256 = hash('sha256', $string);

        $finalXHeader = $sha256 . '###' . $saltIndex;

        $url = "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay";

        // Send the payment request to PhonePe
        $response = Curl::to($url)
            ->withHeader('Content-Type:application/json')
            ->withHeader('X-VERIFY:' . $finalXHeader)
            ->withData(json_encode(['request' => $encode]))
            ->post();

        $rData = json_decode($response);

        // Redirect to the PhonePe payment page
        return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);
    }

    public function response(Request $request)
    {
        $input = $request->all();

        // PhonePe-specific salt and key
        $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
        $saltIndex = 1;

        $finalXHeader = hash('sha256', '/pg/v1/status/' . $input['merchantId'] . '/' . $input['transactionId'] . $saltKey) . '###' . $saltIndex;

        // Retrieve the payment status from PhonePe
        $response = Curl::to('https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status/' . $input['merchantId'] . '/' . $input['transactionId'])
            ->withHeader('Content-Type:application/json')
            ->withHeader('accept:application/json')
            ->withHeader('X-VERIFY:' . $finalXHeader)
            ->withHeader('X-MERCHANT-ID:' . $input['transactionId'])
            ->get();

        // Process and handle the payment response from PhonePe
        $phonePeResponse = json_decode($response);

        // You can perform further actions based on the response data

        return view('phonepe_response')->with('phonePeResponse', $phonePeResponse);
    }
}
