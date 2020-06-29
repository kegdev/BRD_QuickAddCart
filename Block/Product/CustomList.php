<?php

/**
 * @author Kevin Earl Gardner
 * @copyright  MIT License
 * @package BRD_QuickAddCart
 */

namespace BRD\QuickAddCart\Block\Product;

use Magento\Catalog\Block\Product\ListProduct;
use Magento\Catalog\Model\ResourceModel\Collection\AbstractCollection;

class CustomList extends ListProduct
{
    public function getLoadedProductCollection()
    {
        return $this->_productCollection;
    }

    public function setProductCollection(AbstractCollection $collection)
    {
        $this->_productCollection = $collection;
    }
    protected function getPriceRender()
    {
        // debugging pricing block issue - disabling for the time being.
        return;
    }
}
