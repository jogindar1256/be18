<?php

namespace Modules\PhonePe\Response;

use Illuminate\Http\Request;
use Modules\Gateway\Contracts\HasDataResponseInterface;
use Modules\Gateway\Response\Response;

class PhonePeResponse extends Response implements HasDataResponseInterface
{
    protected $response;
    private $data;

    /**
     * Constructor of the response
     *
     * @param object $data (Order data object)
     * @param object $response (Payment response)
     */
    public function __construct($data, $response)
    {
        $this->data = $data;
        $this->response = $response;
        $this->updateStatus();
        return $this;
    }

    /**
     * Get Raw Response
     *
     * @return string
     */
    public function getRawResponse(): string
    {
        return json_encode($this->response->all());
    }

    /**
     * Update Payment Status
     *
     * @return void
     */
    protected function updateStatus()
    {
        // Customize this logic to match the response structure from PhonePe
        // Assume there is a 'responseStatus' field in the PhonePe response
        $responseStatus = $this->response->responseStatus;

        if ($responseStatus === 'SUCCESS') {
            $this->setPaymentStatus('completed');
        } else {
            $this->setPaymentStatus('failed');
        }
    }

    /**
     * Get Response
     *
     * @return string
     */
    public function getResponse(): string
    {
        return json_encode($this->getSimpleResponse());
    }

    /**
     * Get Simple Response
     *
     * @return array
     */
    private function getSimpleResponse()
    {
        // Customize this method to extract relevant data from the PhonePe response
        // Assume there are 'total', 'TXNAMOUNT', 'CURRENCY', and 'errorCode' fields in the PhonePe response
        return [
            'amount' => $this->data->total,
            'amount_captured' => $this->response->TXNAMOUNT,
            'currency' => $this->response->CURRENCY,
            'code' => $this->response->errorCode,
            // Add more fields as needed
        ];
    }

    /**
     * Get Gateway
     *
     * @return string
     */
    public function getGateway(): string
    {
        return 'phonepe'; // Update with your PhonePe gateway name
    }

    /**
     * Set payment status
     *
     * @param string $status
     * @return void
     */
    protected function setPaymentStatus($status)
    {
        $this->status = $status;
    }
}
