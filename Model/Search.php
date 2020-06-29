<?php
/**
 * @author Kevin Earl Gardner
 * @copyright  MIT License
 * @package BRD_QuickAddCart
 */

namespace BRD\QuickAddCart\Model;

use Magento\Store\Model\StoreManagerInterface;
use \BRD\QuickAddCart\Helper\Data as QuickHelper;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable as ConfigurableProduct;

class Search
{

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \BRD\QuickAddCart\Helper\Data
     */
    protected $quickHelper;

    /**
     * @var \Magento\Framework\App\ObjectManager
     */
    protected $objectManager;

    /**
     * @var \Magento\Framework\Api\FilterBuilder
     */
    protected $filterBuilder;

    /**
     * @var \Magento\Framework\Api\Search\FilterGroupBuilder
     */
    protected $filterGroupBuilder;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productRepositoryInterface;

    /**
     * @var \Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable
     */
    protected $configurableProduct;

    public function __construct(
        StoreManagerInterface $storeManager,
        QuickHelper $quickHelper,
        ObjectManagerInterface $objectManager,
        FilterBuilder $filterBuilder,
        FilterGroupBuilder $filterGroupBuilder,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ProductRepositoryInterface $productRepositoryInterface,
        ConfigurableProduct $configurableProduct
    ) {
        $this->storeManager = $storeManager;
        $this->quickHelper = $quickHelper;
        $this->objectManager = $objectManager;
        $this->filterBuilder = $filterBuilder;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->productRepositoryInterface = $productRepositoryInterface;
        $this->configurableProduct = $configurableProduct;
    }

    public function getSearch($searchTerm)
    {
        $resultsLimit = $this->quickHelper->resultsLimit();

        $skuFilter = $this->filterBuilder
        ->setField('sku')
        ->setConditionType('like')
        ->setValue($searchTerm)
        ->create();

        $nameFilter = $this->filterBuilder
        ->setField('name')
        ->setConditionType('like')
        ->setValue($searchTerm)
        ->create();

        $idFilter = $this->filterBuilder
        ->setField('entity_id')
        ->setConditionType('like')
        ->setValue($searchTerm)
        ->create();

        // enable upcFilter UPC product attribute exists on install

        // $upcFilter = $this->filterBuilder
        // ->setField('upc')
        // ->setConditionType('like')
        // ->setValue($searchTerm)
        // ->create();

        $filter_group = $this->filterGroupBuilder
        ->addFilter($skuFilter)
        ->addFilter($nameFilter)
        ->addFilter($idFilter)
        // ->addFilter($upcFilter)
        ->create();

        if($resultsLimit == 0) {
            $search_criteria = $this->searchCriteriaBuilder
            ->setFilterGroups([$filter_group])
            ->create();
        } else {
            $search_criteria = $this->searchCriteriaBuilder
            ->setFilterGroups([$filter_group])
            ->setPageSize($resultsLimit)
            ->create();
        }

        $productCollection  = $this->productRepositoryInterface->getList($search_criteria)->getItems();

        return $productCollection;
    }

    public function getProductTypes($productCollection) {
        $resultsArray = [];
        foreach ($productCollection as $product) {
            $productType = $product->getTypeId();
            if($productType == 'simple') {
                $parentProductsByChild = $this->configurableProduct->getParentIdsByChild($product->getId());
                if(isset($parentProductsByChild[0])) {
                    // $resultsArray = $parentProductsByChild[0] . '_' . $product->getId();
                    $resultsArray[] = $parentProductsByChild[0];
                } else {
                    $resultsArray[] = $product->getId();
                }
            } else {
                $resultsArray[] = $product->getId();
            }
        }
        return $resultsArray;
    }

    /**
     * @return int
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getStoreId()
    {
        return $this->storeManager->getStore()->getId();
    }
}
