<?php
/**
 * Novalnet Abstract Request
 */
namespace Novalnet\Omnipay\Message;

use Novalnet\Omnipay\Gateway;
use Symfony\Component\HttpFoundation\ParameterBag;
use Novalnet\Omnipay\Helper;
use Omnipay\Common\Exception\RuntimeException;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * @var endpoint base URL
     */
    protected const PAYPORT_BASE_URL = 'https://payport.novalnet.de/v2';

    /**
     * @inheritdoc
     */
    abstract public function getEndpoint();

    /**
     * To get payport API end point URL
     *
     * @param  string      $action
     * @param  string|null $type
     * @return string
     */
    public function getEndpointUrl($action, $type = null)
    {
        $endpoint = self::PAYPORT_BASE_URL;
        if (!empty($type)) {
            $endpoint .= '/' . $type;
        }

        return $endpoint .= '/' . $action;
    }

    /**
     * To set payment access key
     *
     * @param  string $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setPaymentAccessKey($value)
    {
        return $this->setParameter('paymentAccessKey', $value);
    }

    /**
     * To get payment access key
     *
     * @return string|null
     */
    public function getPaymentAccessKey()
    {
        return $this->getParameter('paymentAccessKey');
    }

    /**
     * To set signature
     *
     * @param  string $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setSignature($value)
    {
        return $this->setParameter('signature', $value);
    }

    /**
     * To get signature
     *
     * @return string|null
     */
    public function getSignature()
    {
        return $this->getParameter('signature');
    }

    /**
     * To set tariff
     *
     * @param  string $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setTariff($value)
    {
        return $this->setParameter('tariff', $value);
    }

    /**
     * To get tariff
     *
     * @return string|null
     */
    public function getTariff()
    {
        return $this->getParameter('tariff');
    }

    /**
     * To set test mode
     *
     * @param  bool $value
     * @return \Omnipay\Common\ParametersTrait
     */
    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }

    /**
     * To get test mode
     *
     * @return bool
     */
    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    /**
     * {@inheritdoc}
     *
     * Initialize the request parameters and collect them in a parameter bag
     *
     * @param  array $parameters
     * @return mixed
     */
    public function initialize(array $parameters = array())
    {
        if (null !== $this->response) {
            throw new RuntimeException('Request cannot be modified after it has been sent!');
        }

        $this->parameters = new ParameterBag;

        Helper::initialize($this, $parameters);

        return $this;
    }

    /**
     * To get HTTP request headers
     *
     * @return array
     */
    public function getHeaders()
    {
        return [
            'Content-Type' => 'application/json',
            'Charset' => 'utf-8',
            'Accept' => 'application/json',
        ];
    }

    /**
     * {@inheritdoc}
     *
     * Makes the HTTP call to the Gateway server and returns the
     * Payment gateway response.
     *
     * @return \Novalnet\Omnipay\Message\Response
     */
    public function sendData($data)
    {
        $data = Helper::filterStandardParameter($data);
        $headers = array_merge(
            $this->getHeaders(),
            ['X-NN-Access-Key' => base64_encode($this->getPaymentAccessKey())]
        );

        try {
            $body = ($data) ? json_encode($data) : null;
        } catch (\Exception $e) {
            throw new RuntimeException('JSON parse error ' . $e->getMessage());
        }

        $httpResponse = $this->httpClient->request(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            $headers,
            $body
        );

        return $this->createResponse($httpResponse->getBody()->getContents(), $httpResponse->getHeaders());
    }

    /**
     * @inheritdoc
     * Handles the HTTP response from the payment gateway server
     *
     * @param  mixed $data
     * @param  array $headers
     * @return \Novalnet\Omnipay\Message\Response
     */
    protected function createResponse($data, $headers = [])
    {
        return $this->response = new Response($this, $data, $headers);
    }
}
