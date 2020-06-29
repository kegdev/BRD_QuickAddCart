<?php

/**
 * @author Kevin Earl Gardner
 * @copyright  MIT License
 * @package BRD_QuickAddCart
 */

namespace BRD\QuickAddCart\Helper;

use Magento\Store\Model\ScopeInterface;

/**
 * Search Suite Autocomplete config data helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_BRD_QAC_ENABLED = 'brd_qac_general/general_options/enabled';
    const XML_BRD_QAC_RESULTS_LIMIT = 'brd_qac_general/general_options/results_limit';
    const XML_BRD_QAC_ATTRIBUTES_LIMIT = 'brd_qac_general/general_options/attributes_limit';
    const XML_BRD_QAC_DISABLE_ADDTOCART = 'brd_qac_general/general_options/disable_addtocart';

    public function isEnabled() {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_BRD_QAC_ENABLED, $storeScope);
    }

    public function resultsLimit() {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_BRD_QAC_RESULTS_LIMIT, $storeScope);
    }

    public function attributesLimit() {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_BRD_QAC_ATTRIBUTES_LIMIT, $storeScope);
    }

    public function disableAddToCart() {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_BRD_QAC_DISABLE_ADDTOCART, $storeScope);
    }
}
