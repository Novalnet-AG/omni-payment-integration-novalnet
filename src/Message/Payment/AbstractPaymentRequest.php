<?php
/**
 * Novalnet Abstract payment request
 */
namespace Novalnet\Omnipay\Message\Payment;

use Novalnet\Omnipay\Message\AbstractRequest;

abstract class AbstractPaymentRequest extends AbstractRequest
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
     * To set customer parameters
     *
     * @param  array $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setCustomer($value)
    {
        return $this->setParameter('customer', $value);
    }

    /**
     * To get customer parameters
     *
     * @return array
     */
    public function getCustomer()
    {
        return $this->getParameter('customer');
    }

    /**
     * To set transaction parameters
     *
     * @param  array $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setTransaction($value)
    {
        return $this->setParameter('transaction', $value);
    }

    /**
     * To get transaction parameters
     *
     * @return array
     */
    public function getTransaction()
    {
        return $this->getParameter('transaction');
    }

    /**
     * To set subscription parameters
     *
     * @param  array $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setSubscription($value)
    {
        return $this->setParameter('subscription', $value);
    }

    /**
     * To get subscription parameters
     *
     * @return array
     */
    public function getSubscription()
    {
        return $this->getParameter('subscription');
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
     * To set marketplace parameters
     *
     * @param  array $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setMarketplace($value)
    {
        return $this->setParameter('marketplace', $value);
    }

    /**
     * To get marketplace parameters
     *
     * @return array
     */
    public function getMarketplace()
    {
        return $this->getParameter('marketplace');
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
     * To set invoicing parameters
     *
     * @param  array $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setInvoicing($value)
    {
        return $this->setParameter('invoicing', $value);
    }

    /**
     * To get invoicing parameters
     *
     * @return array
     */
    public function getInvoicing()
    {
        return $this->getParameter('invoicing');
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
}
