# Omni Payment Integration by Novalnet

Omnipay is a payment processing library for PHP. It has been designed based on ideas from Active Merchant, plus experience implementing dozens of gateways for CI Merchant. It has a clear and consistent API, is fully unit tested, and even comes with an example application to get you started.

## Advantages
-   Easy configuration for all payment methods
-   One platform for all relevant payment types and related services
-   Complete automation of all payment processes
-   More than 50 fraud prevention modules integrated to prevent risk in real-time
-   Effortless configuration of risk management with fraud prevention
-   Comprehensive affiliate system with automated split conversion of transaction on revenue sharing
-   No PCI DSS certification required when using our payment module
-   Real-time monitoring of the transaction flow from the checkout to the receivables
-   Multilevel claims management with integrated handover to collection and various export functions for the accounting
-   Automated e-mail notification function concerning payment status reports
-   Clear real-time overview and monitoring of payment status
-   Automated bookkeeping report in XML, SOAP, CSV, MT940

## Supported payment methods
-   Direct Debit SEPA
-   Credit/Debit Cards
-   Invoice
-   Prepayment
-   Invoice with payment guarantee
-   Direct Debit SEPA with payment guarantee
-   Instalment by Invoice
-   Instalment by Invoice rate
-   Instalment by Direct Debit SEPA
-   Instalment by Direct Debit SEPA rate
-   iDEAL
-   Sofort
-   giropay
-   Barzahlen/viacash
-   Przelewy24
-   eps
-   PayPal
-   PostFinance Card
-   PostFinance E-Finance
-   Bancontact
-   Multibanco
-   Online bank transfer
-   Alipay
-   WeChat Pay
-   Trustly
-   Cash on delivery

## Key features
*   Secure SSL-encoded gateways
*   Seamless and fast integration of the payment module
*   On-hold transaction configuration in the shop admin panel
*   Easy way of confirmation and cancellation of on-hold transactions (Cancel & Capture option) for Direct Debit SEPA, Direct Debit SEPA with payment guarantee, Credit Card, Invoice, Invoice with payment guarantee, Prepayment & PayPal.
*   Refund option for Credit/Debit Cards, Direct Debit SEPA, Direct Debit SEPA with payment guarantee, Instalment by Direct Debit SEPA, Invoice, Invoice with payment guarantee, Instalment by Invoice, Prepayment, Barzahlen/viacash, Sofort, iDEAL, eps, giropay, PayPal, Przelewy24, PostFinance Card, PostFinance E-Finance, Bancontact & Online bank transfer
*   Responsive templates

##  Installation

The preferred way to install the library is using a [composer](http://getcomposer.org/).
Run the composer required to add dependencies to _composer.json_:

```bash
composer require novalnet/omnipay
```

## Direct Debit SEPA (Authorize) 

```php
<?php
use Novalnet\Omnipay\Gateway;

require '../vendor/autoload.php';

try {
    $data['customer'] = [
                'first_name' => 'novalnet',
                'last_name' => 'tester',
                'email' => 'test@novalnet.de',
                'customer_no' => '147',
                'billing' => [
                    'street' => 'Feringastraße',
                    'house_no' => '4',
                    'city' => 'Unterföhring',
                    'zip' => '85774',
                    'country_code' => 'DE',
                ]
            ];
        $data['transaction'] = [
                'test_mode' => 1,
                'payment_type' => 'DIRECT_DEBIT_SEPA',
                'amount' => '1500',
                'currency' => 'EUR',
                'order_no' => '123456',
                'payment_data' => [
                    'account_holder' => '###ACCOUNT_HOLDER###',
                    'iban' => '###IBAN###',
                ]
            ];
        $data['custom'] = [
                'lang' => 'EN'
            ];            

    $gateway = new Gateway();
    $gateway->setPaymentAccessKey('###YOUR_PAYMENT_ACCESS_KEY###'); // Merchant need to provide the payment access key
    $gateway->setSignature('###YOUR_API_SIGNATURE###'); // Merchant need to provide the Product activation key
    $gateway->setTariff('###YOUR_TARIFF_ID###'); // Merchant need to provide the tariff id

    $response = $gateway->authorize($data)->send();
        
    if ($response->isSuccessful()) {
        print_r($response->getData());
    } elseif ($response->isRedirect()) {
        $response->redirect();
    } else {
        echo $response->getMessage();
    }
} catch (\Exception $e) {
    throw $e;
}
```
## Credit/Debit Card (Authorize & CompleteAuthorize) 

###  To load iframe credit/debit card form

Please find the relevant information about to load iframe credit/debit card form and to get the encrypted credit card values (pan_hash & unique_id) to process the payment [developer portal](https://developer.novalnet.de/onlinepayments/apicreditcard).

```php
<?php
use Novalnet\Omnipay\Gateway;

require '../vendor/autoload.php';

try {
    $data['customer'] = [
                'first_name' => 'novalnet',
                'last_name' => 'tester',
                'email' => 'test@novalnet.de',
                'customer_no' => '147',
                'billing' => [
                    'street' => 'Feringastraße',
                    'house_no' => '4',
                    'city' => 'Unterföhring',
                    'zip' => '85774',
                    'country_code' => 'DE',
                ]
            ];
        $data['transaction'] = [
                'test_mode' => 1,
                'payment_type' => 'CREDITCARD',
                'amount' => '1500',
                'currency' => 'EUR',
                'order_no' => '123456',
		'return_url' => 'https://omnipay.novalnet.de/samples/payment/purchase.php',  // Adapt your own return url (only for 3D secure)
                'payment_data' => [
                    'pan_hash'  => '###PAN_HASH###', // To store Novalnet's unique identifier for the given payment data
		    'unique_id' => '###UNIQUE_ID###' // To store the random id which belongs to a particular pan_hash
                ]
            ];
        $data['custom'] = [
                'lang' => 'EN'
            ];            

    $gateway = new Gateway();
    $gateway->setPaymentAccessKey('###YOUR_PAYMENT_ACCESS_KEY###'); // Merchant need to provide the payment access key
    $gateway->setSignature('###YOUR_API_SIGNATURE###'); // Merchant need to provide the Product activation key
    $gateway->setTariff('###YOUR_TARIFF_ID###'); // Merchant need to provide the tariff id

    $response = empty($_REQUEST['tid'])
        ? $gateway->authorize($data)->send()
        : $gateway->completeAuthorize($_REQUEST)->send();
		
    if ($response->isSuccessful()) {
        print_r($response->getData());
    } elseif ($response->isRedirect()) {
        $response->redirect();
    } else {
        echo $response->getMessage();
    }
} catch (\Exception $e) {
    throw $e;
}
```

## Online bank transfer (Purchase & CompletePurchase) 

```php
<?php
use Novalnet\Omnipay\Gateway;

require '../vendor/autoload.php';

try {
    $data['customer'] = [
                'first_name' => 'novalnet',
                'last_name' => 'tester',
                'email' => 'test@novalnet.de',
                'customer_no' => '147',
                'billing' => [
                    'street' => 'Feringastraße',
                    'house_no' => '4',
                    'city' => 'Unterföhring',
                    'zip' => '85774',
                    'country_code' => 'DE',
                ]
            ];
        $data['transaction'] = [
                'test_mode' => 1,
                'payment_type' => 'ONLINE_BANK_TRANSFER',
                'amount' => '1500',
                'currency' => 'EUR',
                'order_no' => '123456',
                'return_url' => 'https://omnipay.novalnet.de/samples/payment/purchase.php',  // Adapt your own return url
            ];
        $data['custom'] = [
                'lang' => 'EN'
            ];            

    $gateway = new Gateway();
    $gateway->setPaymentAccessKey('###YOUR_PAYMENT_ACCESS_KEY###'); // Merchant need to provide the payment access key
    $gateway->setSignature('###YOUR_API_SIGNATURE###'); // Merchant need to provide the Product activation key
    $gateway->setTariff('###YOUR_TARIFF_ID###'); // Merchant need to provide the tariff id

    $response = empty($_REQUEST['tid'])
        ? $gateway->purchase($data)->send()
        : $gateway->completePurchase($_REQUEST)->send();

    if ($response->isSuccessful()) {
        print_r($response->getData());
    } elseif ($response->isRedirect()) {
        $response->redirect();
    } else {
        echo $response->getMessage();
    }
} catch (\Exception $e) {
    throw $e;
}

```

## Refund
```php
<?php

use Novalnet\Omnipay\Gateway;

require '../vendor/autoload.php';

try {
    $data['transaction'] = [
            'tid' => '14597800007520313',
            'amount' => '100',
            'reason' => ''
        ];

    $data['custom'] = [
            'lang' => 'EN'
        ];

    $gateway = new Gateway();
    $gateway->setPaymentAccessKey('###YOUR_PAYMENT_ACCESS_KEY###'); // Merchant need to provide the payment access key

    $response = $gateway->refund($data)->send();

    if ($response->isSuccessful()) {
        print_r($response->getData());
    } else {
        echo $response->getMessage();
    }

} catch (\Exception $e) {
    throw $e;
}

```
##  Notification Webhooks
```php
<?php

use Novalnet\Omnipay\Gateway;

require '../vendor/autoload.php';

try {
    $gateway = new Gateway();
    $gateway->setPaymentAccessKey('###YOUR_PAYMENT_ACCESS_KEY###'); // Merchant need to provide the payment access key
    $gateway->setTestMode(false);
    $gateway->handleWebhookNotification();
} catch (\Exception $e) {
    throw $e;
}

```
```
 For Webhook synchronization, add the above code in your webhook handler file
```

For more information about payment integration see the [developer portal](https://developer.novalnet.de/).
Please find the relevant documentation about payment integration there.

## License  
See our License Agreement at: https://www.novalnet.com/payment-plugins/free/license

## Documentation & Support
For more information about the omni Payment Integration by Novalnet, please get in touch with us: <a href="mailto:sales@novalnet.de"> sales@novalnet.de </a> or +49 89 9230683-20<br>

Novalnet AG<br>
Zahlungsinstitut (ZAG)<br>
Feringastr. 4<br>
85774 Unterföhring<br>
Deutschland<br>
Website: www.novalnet.de 

## Who is Novalnet?
<p>Novalnet AG is a <a href="https://www.novalnet.de/zahlungsinstitut"> leading financial service institution </a> offering payment gateways for processing online payments. Operating in the market as a full payment service provider Novalnet AG provides online merchants user-friendly payment integration with all major shop systems and self-programmed sites.</p> 
<p>Accept, manage and monitor payments all on one platform with one single contract!</p>
<p>Our SaaS engine is <a href="https://www.novalnet.de/pci-dss-zertifizierung"> PCI DSS </a> certified and designed to enable real-time risk management, secured payments via escrow accounts, efficient receivables management, dynamic member and subscription management, customized payment solutions for various business models (e.g. marketplaces, affiliate programs etc.) etc.</p>
