<?php
/**
 * Novalnet Instalment cancel
 */
namespace Novalnet\Omnipay\Message\Transaction;

class CancelInstalmentRequest extends AbstractTransactionRequest
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
     * To get API endpoint for instalment cancel
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getEndpointUrl('cancel', 'instalment');
    }

    /**
     * To set instalment parameters
     *
     * @param  array $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setInstalment($value)
    {
        return $this->setParameter('instalment', $value);
    }

    /**
     * To get instalment parameters
     *
     * @return array
     */
    public function getInstalment()
    {
        return $this->getParameter('instalment');
    }

    /**
     * To get request parameters
     *
     * @return array
     */
    public function getData()
    {
        $this->validate('instalment', 'paymentAccessKey', 'tid');

        $data = [
            'instalment' => $this->getInstalment(),
            'custom' => $this->getCustom()
        ];

        return $data;
    }
}
