<?php

/**
 * @author Kevin Earl Gardner
 * @copyright  MIT License
 * @package BRD_QuickAddCart
 */

namespace BRD\QuickAddCart\Block\View;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\ObjectManagerInterface;
use Magento\Sales\Model\Order\Item;
use Magento\Customer\Model\Address;
use Magento\Customer\Model\Customer;
use \Magento\Catalog\Model\Layer\Resolver as LayerResolver;
use \BRD\QuickAddCart\Helper\Data as QuickHelper;
use \BRD\QuickAddCart\Model\Search as QuickSearch;

class Index extends Template
{

    /**
     * @var \Magento\Framework\View\Element\Template\Context
     */
    protected $context;

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var \Magento\Sales\Model\Order\Item
     */
    protected $orderItemFactory;

    /**
     * @var \Magento\Customer\Model\Address
     */
    protected $address;

    /**
     * @var \Magento\Customer\Model\Customer
     */
    protected $customer;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $layerResolver;

    /**
     * @var \BRD\QuickAddCart\Helper\Data
     */
    protected $quickHelper;

    /**
     * @var \BRD\QuickAddCart\Model\Search
     */
    protected $quickSearch;

    public function __construct(
        Context $context,
        ObjectManagerInterface $objectManager,
        Item $orderItemFactory,
        Address $address,
        Customer $customer,
        LayerResolver $layerResolver,
        QuickHelper $quickHelper,
        QuickSearch $quickSearch,
        \Magento\Framework\App\Http\Context $_context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_objectManager = $objectManager;
        $this->orderItemFactory = $orderItemFactory;
        $this->_address = $address;
        $this->_customer = $customer;
        $this->layerResolver = $layerResolver;
        $this->quickHelper = $quickHelper;
        $this->quickSearch = $quickSearch;
        $this->_context = $_context;
    }

    public function isEnabled() {
        return $this->quickHelper->isEnabled();
    }

    public function resultsLimit() {
        return $this->quickHelper->resultsLimit();
    }

    public function attributesLimit() {
        return $this->quickHelper->attributesLimit();
    }

    public function disableAddToCart() {
        return $this->quickHelper->disableAddToCart();
    }
}
