<?php

return [
    'name' => 'PhonePe',

    'alias' => 'phonepe',

    'logo' => 'Modules/PhonePe/Resources/assets/phonepe.png',

    'options' => [
        ['label' => __('Settings'), 'type' => 'modal', 'url' => 'phonepe.edit'],
        ['label' => __('PhonePe Documentation'), 'target' => '_blank', 'url' => 'https://example.com/phonepe/docs'],
    ],

    'validation' => [
        'rules' => [
            'api_key' => 'required',
            'api_secret' => 'required',
            'return_url' => 'required',
            'mode' => 'required',
        ],
        'attributes' => [
            'api_key' => __('API Key'),
            'api_secret' => __('API Secret'),
            'return_url' => __('Return URL'),
            'mode' => __('Mode'),
        ],
    ],

    'fields' => [
        'api_key' => [
            'label' => __('API Key'),
            'type' => 'text',
            'required' => true,
        ],
        'api_secret' => [
            'label' => __('API Secret'),
            'type' => 'text',
            'required' => true,
        ],
        'return_url' => [
            'label' => __('Return URL'),
            'type' => 'text',
            'required' => true,
        ],
        'mode' => [
            'label' => __('Mode'),
            'type' => 'select',
            'required' => true,
            'options' => [
                'Production' => 'production',
                'Sandbox' => 'sandbox',
            ],
        ],
    ],

    'store_route' => 'phonepe.store',
];
