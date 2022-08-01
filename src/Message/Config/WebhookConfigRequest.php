<?php
/**
 * Novalnet webhook configure request
 */
namespace Novalnet\Omnipay\Message\Config;

use Novalnet\Omnipay\Message\AbstractRequest;

class WebhookConfigRequest extends AbstractRequest
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
     * To get API endpoint for void
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getEndpointUrl('configure', 'webhook');
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
     * To set webhook parameters
     *
     * @param  array $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setWebhook($value)
    {
        return $this->setParameter('webhook', $value);
    }

    /**
     * To get webhook parameters
     *
     * @return array
     */
    public function getWebhook()
    {
        return $this->getParameter('webhook');
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
     * To set URL
     *
     * @param  string $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setUrl($value)
    {
        return $this->setParameter('url', $value);
    }

    /**
     * To get custom parameters
     *
     * @return string|null
     */
    public function getUrl()
    {
        return $this->getParameter('url');
    }

    /**
     * To get request parameters
     *
     * @return array
     */
    public function getData()
    {
        $this->validate('webhook', 'signature', 'url', 'paymentAccessKey');

        $data = [
            'merchant' => [
                'signature' => $this->getSignature()
            ],
            'webhook' => $this->getWebhook(),
            'custom' => $this->getCustom()
        ];

        return $data;
    }
}
