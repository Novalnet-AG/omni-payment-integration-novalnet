<?php
/**
 * Novalnet Payment Response.
 */
namespace Novalnet\Omnipay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Exception\RuntimeException;

/**
 * Novalnet Response.
 *
 * This is the response class for all Stripe requests.
 *
 * @see \Omnipay\Novalnetv2\Gateway
 */
class Response extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * Request id
     *
     * @var string URL
     */
    protected $requestId = null;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var string
     */
    protected $responseJson = null;

    /**
     * response initiator
     */
    public function __construct(RequestInterface $request, $data, $headers = [])
    {
        $this->request = $request;
        $this->responseJson = $data;
        $this->data = $this->getJsonResponseAsArray();
        $this->headers = $headers;
    }

    /**
     * To get json response as array
     *
     * @return array
     */
    public function getJsonResponseAsArray()
    {
        try {
            return (!empty($this->responseJson)) ? json_decode($this->responseJson, true) : [];
        } catch (\Exception $e) {
            throw new RuntimeException('JSON parse error ' . $e->getMessage());
        }
    }

    /**
     * To get JSON response
     *
     * @return array
     */
    public function getResponseJson()
    {
        return $this->responseJson;
    }

    /**
     * To get response data
     *
     * @return array|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * To get request data
     *
     * @return array|null
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Is the transaction successful?
     *
     * @return bool
     */
    public function isSuccessful()
    {
        if ($this->isRedirect() || (!empty($this->data['result']['status']) && $this->data['result']['status'] == 'FAILURE')) {
            return false;
        }

        return true;
    }

    /**
     * Get the error message from the response.
     *
     * Returns null if the request was successful.
     *
     * @return string|null
     */
    public function getMessage()
    {
        if (!$this->isSuccessful() && !empty($this->data['result']['status_text'])) {
            return $this->data['result']['status_text'];
        }

        return null;
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        if (!empty($this->data['result']['redirect_url'])) {
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getRedirectUrl()
    {
        if (!empty($this->data['result']['redirect_url'])) {
            return $this->data['result']['redirect_url'];
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * @return mixed
     */
    public function getRedirectData()
    {
        if ($this->isRedirect()) {
            return $this->getData();
        }

        return null;
    }

    /**
     * To get response status code
     *
     * @return int|null
     */
    public function getStatusCode()
    {
        if (!empty($this->data['result']['status_code'])) {
            return $this->data['result']['status_code'];
        }

        return null;
    }

    /**
     * To get response headers
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * To get transaction reference (TID)
     *
     * @return string|null
     */
    public function getTransactionReference()
    {
        if (!empty($this->data['transaction']['tid'])) {
            return $this->data['transaction']['tid'];
        }

        return null;
    }

    /**
     * To get transaction status
     *
     * @return string|null
     */
    public function getTransactionStatus()
    {
        if (!empty($this->data['transaction']['status'])) {
            return $this->data['transaction']['status'];
        }

        return null;
    }

    /**
     * To get payment token
     *
     * @return string|null
     */
    public function getPaymentToken()
    {
        if (!empty($this->data['transaction']['payment_data']['token'])) {
            return $this->data['transaction']['payment_data']['token'];
        }

        return null;
    }

    /**
     * To get payment type
     *
     * @return string|null
     */
    public function getPaymentType()
    {
        if (!empty($this->data['transaction']['payment_type'])) {
            return $this->data['transaction']['payment_type'];
        }

        return null;
    }
}
