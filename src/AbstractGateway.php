<?php
/**
 * Novalnet Abstract gateway.
 */
namespace Novalnet\Omnipay;

use Omnipay\Common\AbstractGateway as AbstractOmnipayGateway;

abstract class AbstractGateway extends AbstractOmnipayGateway
{
    abstract public function getName();

    /**
     * To set payment access key
     *
     * @param  string $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setPaymentAccessKey($value)
    {
        return $this->setParameter('paymentAccessKey', $value);
    }

    /**
     * To get payment access key
     *
     * @return string|null
     */
    public function getPaymentAccessKey()
    {
        return $this->getParameter('paymentAccessKey');
    }

    /**
     * To set signature
     *
     * @param  string $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setSignature($value)
    {
        return $this->setParameter('signature', $value);
    }

    /**
     * To get signature
     *
     * @return string|null
     */
    public function getSignature()
    {
        return $this->getParameter('signature');
    }

    /**
     * To set tariff
     *
     * @param  string $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setTariff($value)
    {
        return $this->setParameter('tariff', $value);
    }

    /**
     * To get tariff
     *
     * @return string|null
     */
    public function getTariff()
    {
        return $this->getParameter('tariff');
    }

    /**
     * To set test mode
     *
     * @param  bool $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }

    /**
     * To get test mode
     *
     * @return bool
     */
    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    /**
     * Get the gateway parameters.
     *
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'paymentAccessKey' => null,
            'signature' => null,
            'tariff' => null,
            'test_mode' => false
        );
    }
}
