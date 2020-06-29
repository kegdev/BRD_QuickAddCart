<?php

/**
 * @author Kevin Earl Gardner
 * @copyright  MIT License
 * @package BRD_QuickAddCart
 */

namespace BRD\QuickAddCart\Controller\View;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use \BRD\QuickAddCart\Model\Search as QuickSearch;
use BRD\QuickAddCart\Block\Product\CustomList;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;

class Ajax extends Action
{

    /**
     * @var Magento\Framework\Controller\ResultFactory
     */
    protected $resultFactory;

     /**
     * @var Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var \BRD\QuickAddCart\Model\Search
     */
    protected $quickSearch;

    /** @var  \Magento\Catalog\Model\ResourceModel\Product\Collection */
    protected $_productCollection;

    public function __construct(
        Context $context,
        ResultFactory $resultFactory,
        JsonFactory $resultJsonFactory,
        QuickSearch $quickSearch,
        ProductCollectionFactory $_productCollection
    )
    {
        $this->resultFactory = $resultFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->quickSearch = $quickSearch;
        $this->_productCollection = $_productCollection->create();
        return parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        $resultFactory = $this->resultFactory->create(ResultFactory::TYPE_LAYOUT);

        $term = $this->getRequest()->getParam('term');
        $search = $this->quickSearch->getSearch('%'.$term.'%');
        $products = $this->quickSearch->getProductTypes($search);
        $this->_productCollection->addIdFilter($products);
        $this->_productCollection->addFieldToSelect('*');

        $list = $resultFactory->getLayout()->getBlock('quickadd.products.list');
        $list->setProductCollection($this->_productCollection);

        return $resultFactory;
    }
}
