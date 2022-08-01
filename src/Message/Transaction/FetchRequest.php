<?php
/**
 * Novalnet Transaction Details
 */
namespace Novalnet\Omnipay\Message\Transaction;

class FetchRequest extends AbstractTransactionRequest
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
     * To get API endpoint for fetch transaction details
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getEndpointUrl('details', 'transaction');
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
