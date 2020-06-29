<?php

/**
 * @author Kevin Earl Gardner
 * @copyright  MIT License
 * @package BRD_QuickAddCart
 */

namespace BRD\QuickAddCart\Controller;

use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;

class Index extends \BRD\QuickAddCart\Controller\AbstractQuickAddCart implements HttpGetActionInterface
{

    /**
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * @var Url
     */
    protected $customerUrl;

    public function __construct(
        PageFactory $pageFactory,
        Context $context
    ) {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }

}
