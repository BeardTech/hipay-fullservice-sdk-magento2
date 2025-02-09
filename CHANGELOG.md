# Changelog

## 1.14.0

- **Add**: Added Mutlibanco and MB Way payment methods using Hosted Fields
- **Add**: Added ApplePay public credentials in HiPay configuration
- **Add**: Added `authorization_code` to additional_information in sales_payment_transaction
- **Fix**: Fixed DND Audit feedback

## 1.13.8

- **Fix**: PHP-7.4 compatibility

## 1.13.7

- **Fix**: Fixed CRON for cleaning pending orders

## 1.13.6

- **Fix**: Fixed notification on Capture Refused for orders via API
- **Fix**: Fixed ECI value for orders via Mail Ordering (MO)
- **Fix**: Fixed cancel pending orders CRON
- **Fix**: Fixed auto-cancel timer on Oney payment products

## 1.13.5

- **Fix**: Fixed auto-cancel timer on Paypal payment product
- **Fix**: Update PHP SDK to fix PSD2 parameter recovering

## 1.13.4

- **Fix**: Enabled HostedPage v2 by default
- **Fix**: notifications for retried orders on Hosted Page v2

## 1.13.3

- **Fix**: Merchant promotion oney
- **Fix**: Mbway phone
- **Fix**: Cancel order cron

## 1.13.2

- **Fix**: Expired Authorization notification handling
- **Fix**: Added option to restore the basket when user clicks on back button
- **Fix**: E-mail recovring method
- **Fix**: Split payment error handling
- **Fix**: Multisite category mapping
- **Fix**: SKU handling when making ONEY requests

## 1.13.1

- **Fix**: iDEAL Hosted Fields template

## 1.13.0

- **Add** iDeal Hosted Fields payment method
- **Add** Credit Long payment method
- **Add** Hosted Page v2 option on HostedPage parameters
- **Add** missing fields for Hosted payment methods
- **Fix**: placeOrder button blocking due to other active payment methods [#132](https://github.com/hipay/hipay-fullservice-sdk-magento2/issues/132)
- **Fix**: deprecated method from a Magento dependency
- **Fix**: payment product problem with _hipay_hostedsplit_ payment method

## 1.12.2

- **Fix**: Corrected too high logging levels on some errors

## 1.12.1

- **Fix**: Notification handling
- **Fix**: Order expiration handling

## 1.12.0

- **New**: Add restrictions rules for Oney 3x, 4x
- **Fix**: HiPay card mapping categories
- **Fix**: PHP-7.4 compatibility

## 1.11.0

This release contains SQL changes, be sure to run the magento upgrade command:

     php bin/magento setup:upgrade

- `[BETA]` **New**: ApplePay support
- **New**: Added MB Way payment method
- **New**: Added MB Way product method on Hosted Page
- **New**: Added Illicado product payment on Hosted Page
- **Fix**: Notification processing on capture refused
- **Fix**: Configuration import from UAT to live
- **Fix**: MOTO email template redirect link

## 1.10.2

This release contains SQL changes, be sure to run the magento upgrade command:

     php bin/magento setup:upgrade

- **Fix**: Fix 500 error on checkout
- **Fix**: Corrected HTTP User Agent recovering
- **Fix**: Add custom shipping methods in mappings for dynamic shipping methods

## 1.10.1

- **Fix**: Fixed some errors on capture and notifications

## 1.10.0

- **New**: Added merchant promotion field for Oney With or Without Fees payment methods

## 1.9.1

- **Fix**: Fix Entity query
- **Fix**: Fix js minifying

## 1.9.0

- **New**: Added Multibanco payment method

## 1.8.1

- **Fix**: Removed fake value for shipto_house_number

## 1.8.0

- **New**: Retreive configuration from PHP SDK
- **Fix**: Corrected Astropay

## 1.7.3

- Fix: Missing method for Config class
- Fix: Wrong version in request source

## 1.7.2

- Fix: notification controller 302 HTTP code error (Magento 2.3.2) [#121](https://github.com/hipay/hipay-fullservice-sdk-magento2/issues/121)
- Fix: MO/TO credentials retrieval
- Fix: Disable oneclick when not logged-in
- Fix: Save oneclick cards on 116 and 118 notification

## 1.7.1

- Fix: wrong method declaration (PHP7.1 and less) [#122](https://github.com/hipay/hipay-fullservice-sdk-magento2/issues/122)

## 1.7.0

- Init 3DS V2

## 1.6.1

- Update payment method configuration form
- Fix issue [#119](https://github.com/hipay/hipay-fullservice-sdk-magento2/issues/119)

## 1.6.0

- Add MyBank payment method

## 1.5.0

- Add error message on field
- Update payment method configuration

## 1.4.3

- Fix bad require and bug with magento validation
- Improve notification capture with authorization

## 1.4.2

- Fix multi_use for one-click
- Fix Magento 2.3 compliance

## 1.4.1

- Fix entity name for new magento checks
- Fix Magento 2.3 compliance

## 1.4.0

- **Add Payment Method Hosted Fields**

## 1.3.4

- Fix cvv not mandatory for Maestro card
- Add command to convert data serialized to json

If you are migrating Magento from 2.1.X to 2.2.X and have defined 3DS or OneClick rules, you will need to run the new command to perform the migration.
See: <https://devdocs.magento.com/guides/v2.2/release-notes/backward-incompatible-changes/>

After your magento upgrade, execute in your magento directory:

     php bin/magento hipay:upgradeToJson

## 1.3.3

- Fix the exception with manual captures
- Fix compilation error

## 1.3.2

- [#114](https://github.com/hipay/hipay-fullservice-sdk-magento2/issues/114) Fix issue #114 : Fatal error on failure order (#114)
- Fix : Split payment AI method cannot be displayed alone

## 1.3.1

- Fix : Change refund workflow
- Fix : Split payment status

## 1.3.0

- Add proxy settings (gateway requests)
- Fix : SEPA remove electronic signature
- Fix : partial refund

## 1.2.2

- Fix : Astropay payment method bug
- Fix : Category mapping bug
- Code rework/reformatting

## 1.2.1

- Fix : Api call wrongly formatted (gender)
- Fix : Issue [#107](https://github.com/hipay/hipay-fullservice-sdk-magento2/issues/107)
- Fix : Error on DI compilation [#113](https://github.com/hipay/hipay-fullservice-sdk-magento2/pull/113)
- Add casperJS tests
- Improve CI

## 1.2.0

- Add support for multi-currency payments
- Add hash algorithm selection in BO
- Add notification URL support
- Fix notification response (500 HTTP code on fail)
- Fix : split payment
- Fix : MOTO
- Fix : basket

## 1.1.8

- Add support for product without category and option basket

## 1.1.7

- New payment method support : Bnp Personal Finance 3X and 4X

## 1.1.6

- Fix invoice/credit-memo status (Pending/Paid) for partials captures

## 1.1.5

- Add time_limit_to_pay in HostedPaymentPageRequest
- Remove CDATA parameters ( Use custom_data now )

## 1.1.4

Fixed bugs:

- Missing authentication indicator

## 1.1.3

Fixed bugs:

- Error with RequestHandler compilation

## 1.1.2

Fixed bugs:

- Fix autoclosing tag for fingerprint javascript inclusion
- Change composer installation. Remove module installation in folder (app/code/Hipay). Now installation is in folder vendor
- Fix wrong invoice status with multiple partials capture
- Bad configuration for fingerprint.js

New feature:

- Parameter support : "operation_id"

## 1.1.1

- Bugfix CCType for hosted payment

## 1.1.0

- New feature FACILY PAY ONEY
- New feature KLARNA
- New feature Adding request sources
- New feature Adding custom data
- New feature Adding device fingerprint
- New feature ASTROPAY
- New feature SEPA SDD
- New feature POSTFINANCE
- New feature SOFORT
- New feature WEBMONEY & YANDEX
- New feature PRZELEWY24
- New feature GIROPAY
- New feature iDEAL
- New feature PAYPAL
- New feature Basket V2 (cart synced to HiPay)
- New feature Mapping categories Website <> HiPay
- New feature Mapping carriers Website <> HiPay with delivery date synced to HiPay
- FIX New branding
- FIX translations

## 1.0.8

- Skip Magento fraud checking

## 1.0.7

- Bugfix Add display selector value to TPP request

## 1.0.6

- Bugfix template iFrame send by the request new order

## 1.0.5

- Update documentation URL to the HiPay portal developer

## 1.0.4

- Bugfix PeriodUnit method and Docker image

## 1.0.3

- Bugfix namespace in class Sisal, Qiwi Wallet and unit tests

## 1.0.2

- Update version composer.json with new version PHP SDK and bumps package version

## 1.0.1

- README updates
