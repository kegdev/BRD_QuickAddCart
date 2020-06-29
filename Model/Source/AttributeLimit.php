<?php
/**
 * @author Kevin Earl Gardner
 * @copyright  MIT License
 * @package BRD_QuickAddCart
 */

namespace BRD\QuickAddCart\Model\Source;

class AttributeLimit implements \Magento\Framework\Option\ArrayInterface
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
                'label' => __('5 Attributes')
            ],
            [
                'value' => 10,
                'label' => __('10 Attributes')
            ],
            [
                'value' => 15,
                'label' => __('15 Attributes')
            ],
            [
                'value' => 20,
                'label' => __('20 Attributes')
            ],
            [
                'value' => 25,
                'label' => __('25 Attributes')
            ]
        ];

        return $options;
    }
}
