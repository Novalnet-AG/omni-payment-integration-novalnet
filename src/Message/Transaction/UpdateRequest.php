<?php
/**
 * Novalnet Transaction Update
 */
namespace Novalnet\Omnipay\Message\Transaction;

class UpdateRequest extends AbstractTransactionRequest
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
     * To get API endpoint for transaction update
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getEndpointUrl('update', 'transaction');
    }

    /**
     * To get request parameters
     *
     * @return array
     */
    public function getData()
    {
        $this->validate('transaction', 'tid', 'paymentAccessKey');

        $data = [
            'transaction' => $this->getTransaction(),
            'custom' => $this->getCustom()
        ];

        return $data;
    }
}
