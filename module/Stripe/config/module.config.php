<?php
return [
    'controllers' => [
        'factories' => [
            'Stripe\\V1\\Rpc\\Ping\\Controller' => \Stripe\V1\Rpc\Ping\PingControllerFactory::class,
            'Stripe\\V1\\Rpc\\CheckoutSessionPlan\\Controller' => \Stripe\V1\Rpc\CheckoutSessionPlan\CheckoutSessionPlanControllerFactory::class,
            'Stripe\\V1\\Rpc\\CheckoutSessionDonation\\Controller' => \Stripe\V1\Rpc\CheckoutSessionDonation\CheckoutSessionDonationControllerFactory::class,
            'Stripe\\V1\\Rpc\\SourceBancontact\\Controller' => \Stripe\V1\Rpc\SourceBancontact\SourceBancontactControllerFactory::class,
            'Stripe\\V1\\Rpc\\WebhookCharge\\Controller' => \Stripe\V1\Rpc\WebhookCharge\WebhookChargeControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'stripe.rpc.ping' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/ping',
                    'defaults' => [
                        'controller' => 'Stripe\\V1\\Rpc\\Ping\\Controller',
                        'action' => 'ping',
                    ],
                ],
            ],
            'stripe.rpc.checkout-session' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/checkout/session/plan',
                    'defaults' => [
                        'controller' => 'Stripe\\V1\\Rpc\\CheckoutSessionPlan\\Controller',
                        'action' => 'CheckoutSessionPlan',
                    ],
                ],
            ],
            'stripe.rpc.checkout-session-item' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/checkout/session/donation',
                    'defaults' => [
                        'controller' => 'Stripe\\V1\\Rpc\\CheckoutSessionDonation\\Controller',
                        'action' => 'checkoutSessionDonation',
                    ],
                ],
            ],
            'stripe.rpc.source-bancontact' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/source/bancontact',
                    'defaults' => [
                        'controller' => 'Stripe\\V1\\Rpc\\SourceBancontact\\Controller',
                        'action' => 'sourceBancontact',
                    ],
                ],
            ],
            'stripe.rpc.charge' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/webhook/charge',
                    'defaults' => [
                        'controller' => 'Stripe\\V1\\Rpc\\WebhookCharge\\Controller',
                        'action' => 'charge',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'stripe.rpc.ping',
            1 => 'stripe.rpc.checkout-session',
            2 => 'stripe.rpc.checkout-session-item',
            3 => 'stripe.rpc.source-bancontact',
            4 => 'stripe.rpc.charge',
        ],
    ],
    'zf-rpc' => [
        'Stripe\\V1\\Rpc\\Ping\\Controller' => [
            'service_name' => 'Ping',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'stripe.rpc.ping',
        ],
        'Stripe\\V1\\Rpc\\CheckoutSessionPlan\\Controller' => [
            'service_name' => 'CheckoutSessionPlan',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'stripe.rpc.checkout-session',
        ],
        'Stripe\\V1\\Rpc\\CheckoutSessionDonation\\Controller' => [
            'service_name' => 'CheckoutSessionDonation',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'stripe.rpc.checkout-session-item',
        ],
        'Stripe\\V1\\Rpc\\SourceBancontact\\Controller' => [
            'service_name' => 'SourceBancontact',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'stripe.rpc.source-bancontact',
        ],
        'Stripe\\V1\\Rpc\\WebhookCharge\\Controller' => [
            'service_name' => 'WebhookCharge',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'stripe.rpc.charge',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Stripe\\V1\\Rpc\\Ping\\Controller' => 'Json',
            'Stripe\\V1\\Rpc\\CheckoutSessionPlan\\Controller' => 'Json',
            'Stripe\\V1\\Rpc\\CheckoutSessionDonation\\Controller' => 'Json',
            'Stripe\\V1\\Rpc\\SourceBancontact\\Controller' => 'Json',
            'Stripe\\V1\\Rpc\\WebhookCharge\\Controller' => 'Json',
        ],
        'accept_whitelist' => [
            'Stripe\\V1\\Rpc\\Ping\\Controller' => [
                0 => 'application/vnd.stripe.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'Stripe\\V1\\Rpc\\CheckoutSessionPlan\\Controller' => [
                0 => 'application/vnd.stripe.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'Stripe\\V1\\Rpc\\CheckoutSessionDonation\\Controller' => [
                0 => 'application/vnd.stripe.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'Stripe\\V1\\Rpc\\SourceBancontact\\Controller' => [
                0 => 'application/vnd.stripe.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'Stripe\\V1\\Rpc\\WebhookCharge\\Controller' => [
                0 => 'application/vnd.stripe.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
        ],
        'content_type_whitelist' => [
            'Stripe\\V1\\Rpc\\Ping\\Controller' => [
                0 => 'application/vnd.stripe.v1+json',
                1 => 'application/json',
            ],
            'Stripe\\V1\\Rpc\\CheckoutSessionPlan\\Controller' => [
                0 => 'application/vnd.stripe.v1+json',
                1 => 'application/json',
            ],
            'Stripe\\V1\\Rpc\\CheckoutSessionDonation\\Controller' => [
                0 => 'application/vnd.stripe.v1+json',
                1 => 'application/json',
            ],
            'Stripe\\V1\\Rpc\\SourceBancontact\\Controller' => [
                0 => 'application/vnd.stripe.v1+json',
                1 => 'application/json',
            ],
            'Stripe\\V1\\Rpc\\WebhookCharge\\Controller' => [
                0 => 'application/vnd.stripe.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-content-validation' => [
        'Stripe\\V1\\Rpc\\Ping\\Controller' => [
            'input_filter' => 'Stripe\\V1\\Rpc\\Ping\\Validator',
        ],
        'Stripe\\V1\\Rpc\\CheckoutSessionPlan\\Controller' => [
            'input_filter' => 'Stripe\\V1\\Rpc\\CheckoutSessionPlan\\Validator',
        ],
        'Stripe\\V1\\Rpc\\CheckoutSessionDonation\\Controller' => [
            'input_filter' => 'Stripe\\V1\\Rpc\\CheckoutSessionDonation\\Validator',
        ],
        'Stripe\\V1\\Rpc\\SourceBancontact\\Controller' => [
            'input_filter' => 'Stripe\\V1\\Rpc\\SourceBancontact\\Validator',
        ],
        'Stripe\\V1\\Rpc\\WebhookCharge\\Controller' => [
            'input_filter' => 'Stripe\\V1\\Rpc\\WebhookCharge\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Stripe\\V1\\Rpc\\Ping\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'ack',
            ],
        ],
        'Stripe\\V1\\Rpc\\CheckoutSessionPlan\\Validator' => [
            0 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alpha::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Zend\Validator\InArray::class,
                        'options' => [
                            'strict' => true,
                            'haystack' => [
                                0 => 'auto',
                                1 => 'da',
                                2 => 'de',
                                3 => 'en',
                                4 => 'es',
                                5 => 'fi',
                                6 => 'fr',
                                7 => 'it',
                                8 => 'ja',
                                9 => 'nb',
                                10 => 'nl',
                                11 => 'pl',
                                12 => 'pt',
                                13 => 'sv',
                                14 => 'zh',
                            ],
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringToLower::class,
                        'options' => [],
                    ],
                ],
                'name' => \locale::class,
                'field_type' => '',
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\Uri::class,
                        'options' => [
                            'allowRelative' => false,
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'successUrl',
                'field_type' => 'string',
            ],
            2 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\Uri::class,
                        'options' => [
                            'allowRelative' => false,
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'cancelUrl',
                'field_type' => '',
            ],
            3 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'plan',
            ],
        ],
        'Stripe\\V1\\Rpc\\CheckoutSessionDonation\\Validator' => [
            0 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alpha::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Zend\Validator\InArray::class,
                        'options' => [
                            'strict' => true,
                            'haystack' => [
                                0 => 'auto',
                                1 => 'da',
                                2 => 'de',
                                3 => 'en',
                                4 => 'es',
                                5 => 'fi',
                                6 => 'fr',
                                7 => 'it',
                                8 => 'ja',
                                9 => 'nb',
                                10 => 'nl',
                                11 => 'pl',
                                12 => 'pt',
                                13 => 'sv',
                                14 => 'zh',
                            ],
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringToLower::class,
                        'options' => [],
                    ],
                ],
                'name' => \locale::class,
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\Uri::class,
                        'options' => [
                            'allowRelative' => false,
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'successUrl',
            ],
            2 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\Uri::class,
                        'options' => [
                            'allowRelative' => false,
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'cancelUrl',
            ],
            3 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\IsInt::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'amount',
            ],
            4 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alpha::class,
                        'options' => [],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringToLower::class,
                        'options' => [],
                    ],
                ],
                'name' => 'currency',
            ],
        ],
        'Stripe\\V1\\Rpc\\SourceBancontact\\Validator' => [
            0 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alpha::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Zend\Validator\InArray::class,
                        'options' => [
                            'strict' => true,
                            'haystack' => [
                                0 => 'en',
                                1 => 'de',
                                2 => 'fr',
                                3 => 'nl',
                            ],
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringToLower::class,
                        'options' => [],
                    ],
                ],
                'name' => \locale::class,
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\Uri::class,
                        'options' => [
                            'allowRelative' => false,
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'returnUrl',
            ],
            2 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\IsInt::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'amount',
            ],
            3 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alpha::class,
                        'options' => [],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringToLower::class,
                        'options' => [],
                    ],
                ],
                'name' => 'currency',
            ],
            4 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'ownerName',
            ],
            5 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\EmailAddress::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'ownerEmail',
            ],
            6 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'statementDescriptor',
            ],
        ],
        'Stripe\\V1\\Rpc\\WebhookCharge\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'data',
            ],
        ],
    ],
];
