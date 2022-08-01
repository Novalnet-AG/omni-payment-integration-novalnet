<?php
/**
 * Novalnet subscription suspend
 */
namespace Novalnet\Omnipay\Message\Subscription;

class SuspendRequest extends AbstractSubscriptionRequest
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
     * To get API endpoint for subscription suspend
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getEndpointUrl('suspend', 'subscription');
    }
}
