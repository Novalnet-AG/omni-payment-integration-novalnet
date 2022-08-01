<?php
/**
 * Novalnet subscription reactivate
 */
namespace Novalnet\Omnipay\Message\Subscription;

class ReactivateRequest extends AbstractSubscriptionRequest
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
     * To get API endpoint for subscription reactivate
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getEndpointUrl('reactivate', 'subscription');
    }
}
