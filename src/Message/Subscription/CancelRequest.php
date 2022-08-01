<?php
/**
 * Novalnet subscription cancel
 */
namespace Novalnet\Omnipay\Message\Subscription;

class CancelRequest extends AbstractSubscriptionRequest
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
     * To get API endpoint for subscription cancel
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getEndpointUrl('cancel', 'subscription');
    }
}
