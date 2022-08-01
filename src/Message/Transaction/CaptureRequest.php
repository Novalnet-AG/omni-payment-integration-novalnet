<?php
/**
 * Novalnet Transaction Capture
 */
namespace Novalnet\Omnipay\Message\Transaction;

class CaptureRequest extends AbstractTransactionRequest
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
     * To get API endpoint for capture
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getEndpointUrl('capture', 'transaction');
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
            'custom' => $this->getCustom()
        ];

        return $data;
    }
}
