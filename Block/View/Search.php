<?php

/**
 * @author Kevin Earl Gardner
 * @copyright  MIT License
 * @package BRD_QuickAddCart
 */

namespace BRD\QuickAddCart\Block\View;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Model\Order\Item;
use Magento\Customer\Model\Address;
use Magento\Customer\Model\Customer;
use \Magento\Catalog\Model\Layer\Resolver as LayerResolver;
use \BRD\QuickAddCart\Helper\Data as QuickHelper;
use \BRD\QuickAddCart\Model\Search as QuickSearch;
use \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;

class Search extends Template
{

    /**
     * @var \Magento\Framework\View\Element\Template\Context
     */
    protected $context;

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

    /**
     * @var \BRD\QuickAddCart\Model\Search
     */
    protected $_productCollectionFactory;

    public function __construct(
        Context $context,
        Item $orderItemFactory,
        Address $address,
        Customer $customer,
        LayerResolver $layerResolver,
        QuickHelper $quickHelper,
        QuickSearch $quickSearch,
        ProductCollectionFactory $productCollectionFactory,
        \Magento\Framework\App\Http\Context $_context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->orderItemFactory = $orderItemFactory;
        $this->_address = $address;
        $this->_customer = $customer;
        $this->layerResolver = $layerResolver;
        $this->quickHelper = $quickHelper;
        $this->quickSearch = $quickSearch;
        $this->_productCollectionFactory = $productCollectionFactory;
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

    public function getProductCollection($productIds)
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addIdFilter($productIds);
        $collection->addAttributeToSelect('*');
        return $collection;
    }
}
