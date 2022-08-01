<?php
/**
 * Novalnet subscription update
 */
namespace Novalnet\Omnipay\Message\Subscription;

class UpdateRequest extends AbstractSubscriptionRequest
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
     * To get API endpoint for subscription update
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getEndpointUrl('update', 'subscription');
    }
}
