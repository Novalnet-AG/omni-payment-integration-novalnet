<?php
/**
 * Novalnet Helper
 */
namespace Novalnet\Omnipay;

use Omnipay\Common\Helper as OmnipayHelper;

class Helper extends OmnipayHelper
{
    /**
     * To get server/ remote IP address
     *
     * @param string $type
     *
     * @return string
     */
    public static function getIpAddress($type = 'REMOTE_ADDR')
    {
        if ($type == 'SERVER_ADDR') {
            if (empty($_SERVER['SERVER_ADDR'])) {
                // Handled for IIS server
                $ipAddress = gethostbyname($_SERVER['SERVER_NAME']);
            } else {
                $ipAddress = $_SERVER['SERVER_ADDR'];
            }
        } else {
            // For remote address
            $ipAddress = self::getRemoteAddress();
        }

        return (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) ? '127.0.0.1' : $ipAddress;
    }

    /**
     * To get remote IP address
     *
     * @return string
     */
    public static function getRemoteAddress()
    {
        $ipKeys = ['HTTP_X_FORWARDED_HOST', 'HTTP_CLIENT_IP', 'HTTP_X_REAL_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];

        foreach ($ipKeys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    // trim for safety measures
                    return trim($ip);
                }
            }
        }
    }

    /**
     * Get filter standard param
     *
     * @param array $requestData
     *
     * @return array
     */
    public static function filterStandardParameter($requestData)
    {
        $excludedParams = ['test_mode', 'enforce_3d', 'amount'];

        foreach ($requestData as $key => $value) {
            if (is_array($value)) {
                $requestData[$key] = self::filterStandardParameter($requestData[$key]);
            }

            if (!in_array($key, $excludedParams) && empty($requestData[$key])) {
                unset($requestData[$key]);
            }
        }

        return $requestData;
    }

    /**
     * Initialize an object with a given array of parameters
     *
     * Parameters are automatically converted to camelCase. Any parameters which do
     * not match a setter on the target object are ignored.
     *
     * @param mixed $target     The object to set parameters on
     * @param array $parameters An array of parameters to set
     */
    public static function initialize($target, array $parameters = null)
    {
        if ($parameters) {
            foreach ($parameters as $key => $value) {
                if (is_array($value)) {
                    self::initialize($target, $value);
                }

                $method = 'set'.ucfirst(self::camelCase($key));
                if (method_exists($target, $method)) {
                    $target->$method($value);
                }
            }
        }
    }
}
