<?php

/**
 * @package PhonePeBody
 * @author Your Name <your@email.com>
 * @created Date
 */

namespace Modules\PhonePe\Entities;

use Modules\Gateway\Entities\GatewayBody;

class PhonePeBody extends GatewayBody
{
    public $apiKey;
    public $apiSecret;
    public $instruction;
    public $status;
    public $sandbox;

    public function __construct($request)
    {
        $this->apiKey = $request->apiKey;
        $this->apiSecret = $request->apiSecret;
        $this->instruction = $request->instruction;
        $this->status = $request->status;
        $this->sandbox = $request->sandbox;
    }
}
