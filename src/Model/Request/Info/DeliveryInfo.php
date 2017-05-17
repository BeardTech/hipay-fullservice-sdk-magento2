<?php
/**
 * HiPay fullservice Magento2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Apache 2.0 Licence
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * @copyright      Copyright (c) 2016 - HiPay
 * @license        http://www.apache.org/licenses/LICENSE-2.0 Apache 2.0 Licence
 *
 */
namespace HiPay\FullserviceMagento\Model\Request\Info;

use HiPay\Fullservice\Gateway\Request\Info\DeliveryShippingInfoRequest;
/**
 * Delivery info Request Object
 * 
 * @package HiPay\FullserviceMagento
 * @author Aymeric Berthelot <aberthelot@hipay.com>
 * @copyright Copyright (c) 2017 - HiPay
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache 2.0 Licence
 * @link https://github.com/hipay/hipay-fullservice-sdk-magento2
 */
class DeliveryInfo extends AbstractInfoRequest {
    /**
     * @var \HiPay\FullserviceMagento\Model\ResourceModel\MappingShipping\CollectionFactory
     */
    protected $_mappingShippingCollectionFactory;

    /**
     *  A record frpm Mapping Between Hipay and Magento
     * @var
     */
    protected $_mappingDelivery;

    /**
     *  Collection of Shipping Methods from HiPay
     *
     * @var \HiPay\FullserviceMagento\Model\System\Config\Source\ShippingMethodsHipay
     */
    protected $_shippingMethodsHipay;

    /**
     * {@inheritDoc}
     * @see \HiPay\FullserviceMagento\Model\Request\AbstractRequest::__construct()
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Checkout\Helper\Data $checkoutData,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\Locale\ResolverInterface $localeResolver,
        \HiPay\FullserviceMagento\Model\Request\Type\Factory $requestFactory,
        \Magento\Framework\Url $urlBuilder,
        \HiPay\FullserviceMagento\Helper\Data $helper,
        \HiPay\FullserviceMagento\Model\ResourceModel\MappingShipping\CollectionFactory $mappingShippingCollectionFactory,
        \HiPay\FullserviceMagento\Model\System\Config\Source\ShippingMethodsHipay $shippingMethodsHipay,
        $params = []
    )
    {

        parent::__construct($logger, $checkoutData, $customerSession, $checkoutSession, $localeResolver, $requestFactory, $urlBuilder,$helper,$params);

        if (isset($params['order']) && $params['order'] instanceof \Magento\Sales\Model\Order) {
            $this->_order = $params['order'];
        } else {
            throw new \Exception('Order instance is required.');
        }
        $this->_shippingMethodsHipay = $shippingMethodsHipay;

        // Load Mapping Shipping Method if shipping method exist
        $this->_mappingShippingCollectionFactory = $mappingShippingCollectionFactory;
        if ($this->_order->getShippingMethod()) {
            $collection = $this->_mappingShippingCollectionFactory->create()
                ->addFieldToFilter('magento_shipping_code',$this->_order->getShippingMethod())
                ->load();
            if ($collection->getItems()) {
                $this->_mappingDelivery = $collection->getFirstItem();
            }
        }
    }

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \HiPay\FullserviceMagento\Model\Request\AbstractRequest::mapRequest()
	 * @return \HiPay\FullserviceMagento\Model\Request\Info\DeliveryInfo
	 */
	protected function mapRequest() {
		$deliveryInformation = new DeliveryShippingInfoRequest();
        $deliveryInformation->delivery_date = $this->calculateEstimatedDate();
        $deliveryInformation->delivery_method = $this->getMappingShippingMethod();
		return $deliveryInformation;
	}

    /**
     * According the mapping, provide a approximated date delivery
     *
     * @return date format YYYY-MM-DD
     */
	function calculateEstimatedDate(){
        $today = new \Datetime();
	    if ($this->_mappingDelivery){
            $daysDelay = $this->_mappingDelivery->getDelayPreparation() + $this->_mappingDelivery->getDelayDelivery();
            $interval = new \DateInterval ("P{$daysDelay}D");
            return $today->add($interval)->format("Y-m-d");
        }
        return $today->format("Y-m-d");
    }

    /**
     * Provide a delivery Method compatible with gateway
     *
     * @return null|string
     */
    function getMappingShippingMethod(){
        $codeMappintShipping = $this->_order->getPayment()->getMethodInstance()->getConfigData('default_mapping_shipping_method');
        if ($this->_mappingDelivery) {
            $codeMappintShipping = $this->_mappingDelivery->getHipayShippingId();
        }
        $deliveryMethod = $this->_shippingMethodsHipay->getDeliveryMethodByCode($codeMappintShipping);
        return json_encode(['mode' => $deliveryMethod->getMode(),'shipping' => $deliveryMethod->getShipping()]);

    }

	
}