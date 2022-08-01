<?php
/**
 * Novalnet Transaction refund
 */
namespace Novalnet\Omnipay\Message\Transaction;

class RefundRequest extends AbstractTransactionRequest
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
     * To get API endpoint for refund
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getEndpointUrl('refund', 'transaction');
    }

    /**
     * To get request parameters
     *
     * @return array
     */
    public function getData()
    {
        $this->validate('transaction', 'paymentAccessKey', 'tid');

        $data = [
            'transaction' => $this->getTransaction(),
            'custom' => $this->getCustom(),
            'invoicing' => $this->getInvoicing()
        ];

        return $data;
    }
}
