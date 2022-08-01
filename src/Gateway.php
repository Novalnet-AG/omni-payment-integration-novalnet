<?php
/**
 * Novalnet Gateway.
 */
namespace Novalnet\Omnipay;

use Novalnet\Omnipay\Message\NovalnetWebhooks;

class Gateway extends AbstractGateway
{
    /**
     * @var string
     */
    protected const GATEWAY_NAME = 'Novalnet';

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::GATEWAY_NAME;
    }

    /**
     * @inheritdoc
     * Authorize and immediately capture an amount on the customers card
     *
     * @param  array $parameters
     * @return \Novalnet\Omnipay\Message\Payment\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Novalnet\Omnipay\Message\Payment\PurchaseRequest', $parameters);
    }

    /**
     * @inheritdoc
     * Handle return from off-site gateways after purchase
     *
     * @param  array $parameters
     * @return \Novalnet\Omnipay\Message\Payment\CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Novalnet\Omnipay\Message\Payment\CompletePurchaseRequest', $parameters);
    }

    /**
     * @inheritdoc
     * Authorize an amount on the customers card
     *
     * @param  array $parameters
     * @return \Novalnet\Omnipay\Message\Payment\AuthorizeRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Novalnet\Omnipay\Message\Payment\AuthorizeRequest', $parameters);
    }

    /**
     * @inheritdoc
     * Handle return from off-site gateways after authorization
     *
     * @param  array $parameters
     * @return \Novalnet\Omnipay\Message\Payment\CompleteAuthorizeRequest
     */
    public function completeAuthorize(array $parameters = array())
    {
        return $this->createRequest('\Novalnet\Omnipay\Message\Payment\CompleteAuthorizeRequest', $parameters);
    }

    /**
     * @inheritdoc
     * Fetches transaction information from the Novalnet server
     *
     * @param  array $parameters
     * @return \Novalnet\Omnipay\Message\Transaction\FetchRequest
     */
    public function fetchTransaction(array $parameters = array())
    {
        return $this->createRequest('\Novalnet\Omnipay\Message\Transaction\FetchRequest', $parameters);
    }

    /**
     * @inheritdoc
     * Capture an amount you have previously authorized
     *
     * @param  array $parameters
     * @return \Novalnet\Omnipay\Message\Transaction\CaptureRequest
     */
    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Novalnet\Omnipay\Message\Transaction\CaptureRequest', $parameters);
    }

    /**
     * @inheritdoc
     * Voiding an amount you have previously authorized
     *
     * @param  array $parameters
     * @return \Novalnet\Omnipay\Message\Transaction\VoidRequest
     */
    public function void(array $parameters = array())
    {
        return $this->createRequest('\Novalnet\Omnipay\Message\Transaction\VoidRequest', $parameters);
    }

    /**
     * @inheritdoc
     * Refund an already processed transaction
     *
     * @param  array $parameters
     * @return \Novalnet\Omnipay\Message\Transaction\RefundRequest
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Novalnet\Omnipay\Message\Transaction\RefundRequest', $parameters);
    }

    /**
     * This action will update the existing transaction`s attributes
     * like amount, Due date and Order number.
     *
     * @param  array $parameters
     * @return \Novalnet\Omnipay\Message\Transaction\UpdateRequest
     */
    public function updateTransaction(array $parameters = array())
    {
        return $this->createRequest('\Novalnet\Omnipay\Message\Transaction\UpdateRequest', $parameters);
    }

    /**
     * This action will cancel the existing instalments.
     *
     * @param  array $parameters
     * @return \Novalnet\Omnipay\Message\Transaction\CancelInstalmentRequest
     */
    public function cancelInstalment(array $parameters = array())
    {
        return $this->createRequest('\Novalnet\Omnipay\Message\Transaction\CancelInstalmentRequest', $parameters);
    }

    /**
     * This API will list the available payment methods along with the
     * merchant credentials like Vendor ID, Project ID, available tariff, etc.
     *
     * @param  array $parameters
     * @return \Novalnet\Omnipay\Message\Config\MerchantInfoRequest
     */
    public function fetchMerchantInformation(array $parameters = array())
    {
        return $this->createRequest('\Novalnet\Omnipay\Message\Config\MerchantInfoRequest', $parameters);
    }

    /**
     * This action is used to create/add the new affiliate.
     *
     * @param  array $parameters
     * @return \Novalnet\Omnipay\Message\Affiliate\CreateRequest
     */
    public function createAffiliate(array $parameters = array())
    {
        return $this->createRequest('\Novalnet\Omnipay\Message\Affiliate\CreateRequest', $parameters);
    }

    /**
     * This action is used to configure webhook URL for notification handling.
     *
     * @param  array $parameters
     * @return \Novalnet\Omnipay\Message\Config\WebhookConfigRequest
     */
    public function configureWebhook(array $parameters = array())
    {
        return $this->createRequest('\Novalnet\Omnipay\Message\Config\WebhookConfigRequest', $parameters);
    }

    /**
     * This action will reactivate the existing subscription which has been suspended before.
     *
     * @param  array $parameters
     * @return \Novalnet\Omnipay\Message\Subscription\ReactivateRequest
     */
    public function subscriptionReactivate(array $parameters = array())
    {
        return $this->createRequest('\Novalnet\Omnipay\Message\Subscription\ReactivateRequest', $parameters);
    }

    /**
     * This action will pause the existing subscription.
     *
     * @param  array $parameters
     * @return \Novalnet\Omnipay\Message\Subscription\SuspendRequest
     */
    public function subscriptionSuspend(array $parameters = array())
    {
        return $this->createRequest('\Novalnet\Omnipay\Message\Subscription\SuspendRequest', $parameters);
    }

    /**
     * This action will update the existing subscription`s attributes
     * like amount or next recurring date.
     *
     * @param  array $parameters
     * @return \Novalnet\Omnipay\Message\Subscription\UpdateRequest
     */
    public function subscriptionUpdate(array $parameters = array())
    {
        return $this->createRequest('\Novalnet\Omnipay\Message\Subscription\UpdateRequest', $parameters);
    }

    /**
     * This action will cancel the existing subscription.
     *
     * @param  array $parameters
     * @return \Novalnet\Omnipay\Message\Subscription\CancelRequest
     */
    public function subscriptionCancel(array $parameters = array())
    {
        return $this->createRequest('\Novalnet\Omnipay\Message\Subscription\CancelRequest', $parameters);
    }

    /**
     * To handle webhook notifications
     *
     * @return \Novalnet\Omnipay\Message\NovalnetWebhooks
     */
    public function handleWebhookNotification()
    {
        return new NovalnetWebhooks($this);
    }
}
