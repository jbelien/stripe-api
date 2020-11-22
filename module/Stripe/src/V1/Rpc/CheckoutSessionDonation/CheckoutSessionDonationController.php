<?php

namespace Stripe\V1\Rpc\CheckoutSessionDonation;

use Exception;
use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\ApiProblem\View\ApiProblemModel;
use Laminas\ApiTools\ContentNegotiation\ViewModel;
use Laminas\ApiTools\ContentValidation\InputFilter;
use Laminas\Mvc\Controller\AbstractActionController;
use Stripe\Checkout\Session;
use Stripe\Stripe;

/**
 * @link https://stripe.com/docs/api/checkout/sessions/create
 */
class CheckoutSessionDonationController extends AbstractActionController
{
    /** @var string */
    private $connectAccount;

    /** @var float */
    private $fee;

    /** @var string */
    private $secretKey;

    public function __construct(string $secretKey, ?string $connectAccount = null, float $fee = 0)
    {
        $this->secretKey = $secretKey;
        $this->connectAccount = $connectAccount;
        $this->fee = $fee;
    }

    public function checkoutSessionDonationAction()
    {
        $event = $this->getEvent();
        $data = $event->getParam(InputFilter::class)->getValues();

        try {
            Stripe::setApiKey($this->secretKey);

            $params = [
                'mode'                 => 'payment',
                'submit_type'          => 'donate',
                'locale'               => $data['locale'] ?? 'auto',
                'success_url'          => $data['successUrl'] ?? null,
                'cancel_url'           => $data['cancelUrl'] ?? null,
                'payment_method_types' => ['card', 'bancontact'],
                'line_items'           => [
                    [
                        'quantity'   => 1,
                        'price_data' => [
                            'currency'     => $data['currency'] ?? null,
                            'unit_amount'  => $data['amount'] ?? null,
                            'product_data' => [
                                'name' => 'Single donation',
                            ],
                        ],
                    ],
                ],
                'payment_intent_data' => [
                    'description' => $data['message'] ?? null,
                ],
            ];

            $options = [];
            if (!is_null($this->connectAccount)) {
                $options['stripe_account'] = $this->connectAccount;

                if ($this->fee > 0) {
                    $params['payment_intent_data']['application_fee_amount'] =  $data['amount'] * $this->fee;
                }
            }

            $session = Session::create($params, $options);

            return new ViewModel($session->toArray());
        } catch (Exception $exception) {
            return new ApiProblemModel(new ApiProblem(500, $exception->getMessage()));
        }
    }
}
