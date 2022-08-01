<?php
/**
 * Novalnet payment complete authorize
 */
namespace Novalnet\Omnipay\Message\Payment;

class CompleteAuthorizeRequest extends AbstractCompletePaymentRequest
{
    /**
     * To get HTTP method for the API call
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * To get API endpoint for complete purchase
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getEndpointUrl('details', 'transaction');
    }
}
