<?php
/**
 * Novalnet Affiliate create request
 */
namespace Novalnet\Omnipay\Message\Affiliate;

use Novalnet\Omnipay\Message\AbstractRequest;

class CreateRequest extends AbstractRequest
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
     * To get API endpoint for Affiliate creation
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getEndpointUrl('create', 'affiliate');
    }

    /**
     * To set merchant parameters
     *
     * @param  array $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setMerchant($value)
    {
        return $this->setParameter('merchant', $value);
    }

    /**
     * To get merchant parameters
     *
     * @return array
     */
    public function getMerchant()
    {
        return $this->getParameter('merchant');
    }

    /**
     * To set affiliate parameters
     *
     * @param  array $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setAffiliate($value)
    {
        return $this->setParameter('affiliate', $value);
    }

    /**
     * To get affiliate parameters
     *
     * @return array
     */
    public function getAffiliate()
    {
        return $this->getParameter('affiliate');
    }

    /**
     * To set custom parameters
     *
     * @param  array $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setCustom($value)
    {
        return $this->setParameter('custom', $value);
    }

    /**
     * To get custom parameters
     *
     * @return array
     */
    public function getCustom()
    {
        return $this->getParameter('custom');
    }

    /**
     * To get request parameters
     *
     * @return array
     */
    public function getData()
    {
        $this->validate('affiliate', 'signature', 'paymentAccessKey');

        $data = [
            'merchant' => [
                'signature' => $this->getSignature()
            ],
            'affiliate' => $this->getAffiliate(),
            'custom' => $this->getCustom()
        ];

        return $data;
    }
}
