<?php

namespace Modules\PhonePe\Processor;

use Modules\PhonePe\Library\EncdecPhonePe;
use Illuminate\Support\Facades\Config;
use GuzzleHttp\Client;

class PhonePeProcessor
{
    /**
     * Initialize a new transaction with PhonePe.
     *
     * @param array $params
     * @return array
     */
    public static function initializeTransaction($params)
    {
        // Define the PhonePe API URL for transaction initiation
        $phonePeApiUrl = 'https://api.phonepe.com/initialize-transaction';

        // Prepare your request data based on PhonePe's documentation
        $requestData = [
            'amount' => $params['amount'],
            'order_id' => $params['order_id'],
            // Add other required parameters
        ];

        // Generate a checksum for the request data
        $requestChecksum = EncdecPhonePe::getChecksumFromArray($requestData, Config::get('phonepe.api_secret'));

        // Add the checksum to the request data
        $requestData['checksum'] = $requestChecksum;

        // Create a Guzzle HTTP client for making API requests
        $client = new Client();

        try {
            // Make a POST request to PhonePe's API
            $response = $client->request('POST', $phonePeApiUrl, [
                'json' => $requestData,
            ]);

            // Parse the response
            $responseData = json_decode($response->getBody(), true);

            // Check the response for success
            if ($responseData['status'] === 'success') {
                return [
                    'status' => 'success',
                    'redirect_url' => $responseData['redirect_url'],
                    'transaction_id' => $responseData['transaction_id'],
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => $responseData['message'],
                ];
            }
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Failed to initialize PhonePe transaction.',
            ];
        }
    }

    /**
     * Verify the transaction status with PhonePe.
     *
     * @param string $transactionId
     * @return array
     */
    public static function checkTransactionStatus($transactionId)
    {
        // Define the PhonePe API URL for checking transaction status
        $phonePeApiUrl = 'https://api.phonepe.com/check-transaction-status';

        // Prepare your request data based on PhonePe's documentation
        $requestData = [
            'transaction_id' => $transactionId,
            // Add other required parameters
        ];

        // Generate a checksum for the request data
        $requestChecksum = EncdecPhonePe::getChecksumFromArray($requestData, Config::get('phonepe.api_secret'));

        // Add the checksum to the request data
        $requestData['checksum'] = $requestChecksum;

        // Create a Guzzle HTTP client for making API requests
        $client = new Client();

        try {
            // Make a POST request to PhonePe's API
            $response = $client->request('POST', $phonePeApiUrl, [
                'json' => $requestData,
            ]);

            // Parse the response
            $responseData = json_decode($response->getBody(), true);

            // Check the response for the transaction status
            if ($responseData['status'] === 'success') {
                return [
                    'status' => 'success',
                    'transaction_status' => $responseData['transaction_status'],
                    // Add more relevant data from the response
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => $responseData['message'],
                ];
            }
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Failed to check PhonePe transaction status.',
            ];
        }
    }
}
