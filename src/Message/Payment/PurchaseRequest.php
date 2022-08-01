<?php
/**
 * Novalnet payment purchase request
 */
namespace Novalnet\Omnipay\Message\Payment;

use Novalnet\Omnipay\Helper;

class PurchaseRequest extends AbstractPaymentRequest
{
    /**
     * To get API endpoint for Purchase
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getEndpointUrl('payment');
    }

    /**
     * To get request parameters
     *
     * @return array
     */
    public function getData()
    {
        $this->validate('customer', 'transaction', 'signature', 'tariff', 'paymentAccessKey');

        $data = [
            'merchant' => [
                'signature' => $this->getSignature(),
                'tariff' => $this->getTariff()
            ],
            'customer' => $this->getCustomer(),
            'transaction' => $this->getTransaction(),
            'subscription' => $this->getSubscription(),
            'instalment' => $this->getInstalment(),
            'marketplace' => $this->getMarketplace(),
            'affiliate' => $this->getAffiliate(),
            'invoicing' => $this->getInvoicing(),
            'custom' => $this->getCustom()
        ];

        if (empty($data['customer']['customer_ip'])) {
            $data['customer']['customer_ip'] = Helper::getIpAddress();
        }

        if (empty($data['transaction']['test_mode'])) {
            $data['transaction']['test_mode'] = $this->getTestMode() ? 1 : 0;
        }

        $data['transaction']['system_ip'] = Helper::getIpAddress('SERVER_ADDR');

        return $data;
    }
}
