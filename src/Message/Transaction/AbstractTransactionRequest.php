<?php
/**
 * Novalnet Abstract transaction request
 */
namespace Novalnet\Omnipay\Message\Transaction;

use Novalnet\Omnipay\Message\AbstractRequest;

abstract class AbstractTransactionRequest extends AbstractRequest
{
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
     * To set refund amount
     *
     * @param  mixed $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    /**
     * To get refund amount
     *
     * @return mixed
     */
    public function getAmount()
    {
        return $this->getParameter('amount');
    }
}
