<?php
/**
 * @author Kevin Earl Gardner
 * @copyright  MIT License
 * @package BRD_QuickAddCart
 */

namespace BRD\QuickAddCart\Model\Source;

class MaxResults implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => 0,
                'label' => __('Unlimited')
            ],
            [
                'value' => 5,
                'label' => __('5 Results')
            ],
            [
                'value' => 10,
                'label' => __('10 Results')
            ],
            [
                'value' => 15,
                'label' => __('15 Results')
            ],
            [
                'value' => 20,
                'label' => __('20 Results')
            ],
            [
                'value' => 25,
                'label' => __('25 Results')
            ]
        ];

        return $options;
    }
}
