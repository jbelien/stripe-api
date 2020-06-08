<?php

namespace Stripe\V1\Rpc\WebhookCharge;

use Exception;
use Stripe\Charge;
use Stripe\Stripe;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\ApiProblem\View\ApiProblemModel;
use Laminas\ApiTools\ContentNegotiation\ViewModel;
use Laminas\ApiTools\ContentValidation\InputFilter;

/**
 * @link https://stripe.com/docs/api/charges/create
 */
class WebhookChargeController extends AbstractActionController
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

    public function chargeAction()
    {
        $event = $this->getEvent();
        $data = $event->getParam(InputFilter::class)->getValues();

        $object = $data['data']['object'] ?? [];

        try {
            Stripe::setApiKey($this->secretKey);

            $params = [
                'amount'               => $object['amount'] ?? null,
                'currency'             => $object['currency'] ?? null,
                'source'               => $object['id'] ?? null,
                'receipt_email'        => $object['owner']['email'] ?? null,
                'statement_descriptor' => $object['statement']['descriptor'] ?? null,
            ];

            $options = [];
            if (!is_null($this->connectAccount)) {
                $options['stripe_account'] = $this->connectAccount;

                if ($this->fee > 0) {
                    $params = array_merge(
                        $params,
                        [
                            'application_fee_amount' => $object['amount'] * $this->fee,
                        ]
                    );
                }
            }

            $charge = Charge::create($params, $options);

            return new ViewModel($charge->toArray());
        } catch (Exception $exception) {
            return new ApiProblemModel(new ApiProblem(500, $exception->getMessage()));
        }

        return new ViewModel($data);
    }
}
