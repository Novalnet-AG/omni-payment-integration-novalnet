<?php
/**
 * Novalnet merchant info request
 */
namespace Novalnet\Omnipay\Message\Config;

use Novalnet\Omnipay\Message\AbstractRequest;

class MerchantInfoRequest extends AbstractRequest
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
     * To get merchant details API endpoint
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getEndpointUrl('details', 'merchant');
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
        $this->validate('signature', 'paymentAccessKey');

        $data = [
            'merchant' => [
                'signature' => $this->getSignature()
            ],
            'custom' => $this->getCustom()
        ];

        return $data;
    }
}
