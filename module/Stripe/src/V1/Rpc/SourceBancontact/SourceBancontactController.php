<?php

namespace Stripe\V1\Rpc\SourceBancontact;

use Exception;
use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\ApiProblem\View\ApiProblemModel;
use Laminas\ApiTools\ContentNegotiation\ViewModel;
use Laminas\ApiTools\ContentValidation\InputFilter;
use Laminas\Mvc\Controller\AbstractActionController;
use Stripe\Source;
use Stripe\Stripe;

/**
 * @link https://stripe.com/docs/api/sources/create
 */
class SourceBancontactController extends AbstractActionController
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

    public function sourceBancontactAction()
    {
        $event = $this->getEvent();
        $data = $event->getParam(InputFilter::class)->getValues();

        try {
            Stripe::setApiKey($this->secretKey);

            $params = [
                'type'     => 'bancontact',
                'amount'   => $data['amount'] ?? null,
                'currency' => $data['currency'] ?? null,
                'owner'    => [
                    'name'  => $data['ownerName'] ?? null,
                    'email' => $data['ownerEmail'] ?? null,
                ],
                'redirect' => [
                    'return_url' => $data['returnUrl'] ?? null,
                ],
                'statement_descriptor' => $data['statementDescriptor'] ?? null,
            ];

            if (!is_null($data['locale'])) {
                $params = array_merge($params, [
                    'bancontact' => [
                        'preferred_language' => $data['locale'],
                    ],
                ]);
            }

            $options = [];
            if (!is_null($this->connectAccount)) {
                $options['stripe_account'] = $this->connectAccount;
            }

            $source = Source::create($params, $options);

            return new ViewModel($source->toArray());
        } catch (Exception $exception) {
            return new ApiProblemModel(new ApiProblem(500, $exception->getMessage()));
        }
    }
}
