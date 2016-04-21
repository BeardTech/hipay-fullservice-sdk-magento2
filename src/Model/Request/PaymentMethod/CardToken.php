<?php
/*
 * HiPay fullservice SDK
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @copyright      Copyright (c) 2016 - HiPay
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 *
 */
namespace HiPay\FullserviceMagento\Model\Request\PaymentMethod;

use HiPay\Fullservice\Gateway\Request\PaymentMethod\CardTokenPaymentMethod;
use Magento\Framework\Exception\LocalizedException;

class CardToken extends AbstractPaymentMethod{


	protected function mapRequest() {
		
		//Token can be empty
		$cardtoken = $this->_order->getPayment()->getAdditionalInformation('card_token');
		
		$cardTokenPaymentMethod = new CardTokenPaymentMethod();
		$cardTokenPaymentMethod->authentication_indicator = $this->_helper->is3dSecure($this->_config->getValue('authentication_indicator'), $this->_config->getValue('config_3ds_rules'),$this->getQuote());
		$cardTokenPaymentMethod->cardtoken = $cardtoken;
		$cardTokenPaymentMethod->eci = 7;
		
		return $cardTokenPaymentMethod;
	}
}