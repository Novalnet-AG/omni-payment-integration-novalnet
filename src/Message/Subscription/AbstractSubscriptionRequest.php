<?php
/**
 * Novalnet Abstract subscription request
 */
namespace Novalnet\Omnipay\Message\Subscription;

use Novalnet\Omnipay\Message\AbstractRequest;

abstract class AbstractSubscriptionRequest extends AbstractRequest
{
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
     * To get transaction parameters
     *
     * @return array
     */
    public function getSubscription()
    {
        return $this->getParameter('subscription');
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
     * To set tid
     *
     * @param  string|int $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setTid($value)
    {
        return $this->setParameter('tid', $value);
    }

    /**
     * To get tid
     *
     * @return string|null
     */
    public function getTid()
    {
        return $this->getParameter('tid');
    }

    /**
     * To get request parameters
     *
     * @return array
     */
    public function getData()
    {
        $this->validate('subscription', 'tid', 'paymentAccessKey');

        $data = [
            'subscription' => $this->getSubscription(),
            'custom' => $this->getCustom()
        ];

        return $data;
    }
}
