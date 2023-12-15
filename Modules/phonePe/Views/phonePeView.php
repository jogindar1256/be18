<?php

/**
 * @package PhonePeView
 * @contributor Your Name <your@email.com>
 * @created Date
 */

namespace Modules\PhonePe\Views;

use Modules\PhonePe\Entities\PhonePe;
use Modules\Gateway\Contracts\PaymentViewInterface;
use Modules\Gateway\Services\GatewayHelper;
use Modules\Gateway\Traits\ApiResponse;

class PhonePeView implements PaymentViewInterface
{
    use ApiResponse;

    /**
     * PhonePe payment view
     *
     * @param String $key
     * @return view|redirectResponse
     */
    public static function paymentView($key)
    {
        $helper = GatewayHelper::getInstance();

        try {
            $phonePe = PhonePe::firstWhere('alias', 'phonepe')->data;

            return view('phonepe::pay', [
                'merchantId' => $phonePe->merchantId,
                'merchantKey' => $phonePe->merchantKey,
                'merchantWebsite' => $phonePe->merchantWebsite,
                'instruction' => $phonePe->instruction,
                'purchaseData' => $helper->getPurchaseData($key)
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => __('Purchase data not found.')]);
        }
    }

    /**
     * PhonePe payment response
     *
     * @param String $key
     * @return Array
     */
    public static function paymentResponse($key)
    {
        $helper = GatewayHelper::getInstance();

        $phonePe = PhonePe::firstWhere('alias', 'phonepe')->data;
        return [
            'merchantId' => $phonePe->merchantId,
            'merchantKey' => $phonePe->merchantKey,
            'merchantWebsite' => $phonePe->merchantWebsite,
            'instruction' => $phonePe->instruction,
            'purchaseData' => $helper->getPurchaseData($key)
        ];
    }
}
