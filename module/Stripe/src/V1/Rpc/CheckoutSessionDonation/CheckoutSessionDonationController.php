<?php

namespace Stripe\V1\Rpc\CheckoutSessionDonation;

use Exception;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\ApiProblem\View\ApiProblemModel;
use Laminas\ApiTools\ContentNegotiation\ViewModel;
use Laminas\ApiTools\ContentValidation\InputFilter;

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
                        'name'     => 'Single donation',
                        'amount'   => $data['amount'] ?? null,
                        'currency' => $data['currency'] ?? null,
                        'quantity' => 1,
                    ],
                ],
            ];

            $options = [];
            if (!is_null($this->connectAccount)) {
                $options['stripe_account'] = $this->connectAccount;

                if ($this->fee > 0) {
                    $params = array_merge(
                        $params,
                        [
                            'payment_intent_data' => [
                                'application_fee_amount' => $data['amount'] * $this->fee,
                            ],
                        ]
                    );
                }
            }

            $session = Session::create($params, $options);

            return new ViewModel($session->toArray());
        } catch (Exception $exception) {
            return new ApiProblemModel(new ApiProblem(500, $exception->getMessage()));
        }
    }
}
