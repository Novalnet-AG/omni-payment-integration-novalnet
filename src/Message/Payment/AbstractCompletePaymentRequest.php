<?php
/**
 * Novalnet Abstract payment request
 */
namespace Novalnet\Omnipay\Message\Payment;

use Novalnet\Omnipay\Message\AbstractRequest;
use Omnipay\Common\Exception\RuntimeException;

abstract class AbstractCompletePaymentRequest extends AbstractRequest
{
    /**
     * To set checksum
     *
     * @param  string $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setCheckSum($value)
    {
        return $this->setParameter('checksum', $value);
    }

    /**
     * To get checksum
     *
     * @return string|null
     */
    public function getCheckSum()
    {
        return $this->getParameter('checksum');
    }

    /**
     * To set tid
     *
     * @param  string $value
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
     * To set status
     *
     * @param  string $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setStatus($value)
    {
        return $this->setParameter('status', $value);
    }

    /**
     * To get status
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->getParameter('status');
    }

    /**
     * To set transaction secret
     *
     * @param  string $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setTxnSecret($value)
    {
        return $this->setParameter('txnSecret', $value);
    }

    /**
     * To get transaction secret
     *
     * @return string|null
     */
    public function getTxnSecret()
    {
        return $this->getParameter('txnSecret');
    }

    /**
     * To set payment type
     *
     * @param  string $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setPaymentType($value)
    {
        return $this->setParameter('paymentType', $value);
    }

    /**
     * To get payment type
     *
     * @return string|null
     */
    public function getPaymentType()
    {
        return $this->getParameter('paymentType');
    }

    /**
     * To get request parameters
     *
     * @return array
     */
    public function getData()
    {
        $this->validate('checksum', 'tid', 'status', 'paymentAccessKey', 'txnSecret');

        if (!$this->validateChecksum()) {
            throw new RuntimeException('While redirecting some data has been changed. The hash check failed.');
            return false;
        }

        $data = [
            'transaction' => [
                'tid' => $this->getTid()
            ]
        ];

        return $data;
    }

    /**
     * Validate checksum from response
     *
     * @return bool
     */
    protected function validateChecksum()
    {
        $checksumString = $this->getTid() . $this->getTxnSecret() . $this->getStatus() . strrev($this->getPaymentAccessKey());
        $generatedChecksum = (!empty($checksumString)) ? hash('sha256', $checksumString) : '';

        if ($generatedChecksum !== $this->getCheckSum()) {
            return false;
        }

        return true;
    }
}
