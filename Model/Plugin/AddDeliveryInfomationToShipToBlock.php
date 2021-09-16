<?php

namespace Magenest\DeliveryTime\Model\Plugin;

class AddDeliveryInfomationToShipToBlock
{
    /**
     * Checkout LayoutProcessor after process plugin.
     *
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $processor
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessor $processor, $jsLayout)
    {
        $billingConfiguration = $jsLayout['components']['checkout']['children']['steps']['children']['billing-step'];
        $shipToBlock = &$jsLayout['components']['checkout']['children']['sidebar']['children']['shipping-information']['children']['ship-to'];

        //Checks if shipping step available.
        if (isset($billingConfiguration) && isset($shipToBlock)) {
//            die;;
//            $shipToBlock = [
//                'component' => 'Magento_Checkout/js/single-checkbox',
//                'config' => [
//                    'customScope' => 'shippingAddress',
//                    'template' => 'ui/form/field',
//                    'prefer' => 'checkbox'
//                ],
//                'dataScope' => '.custom_checkbox',
//                'label' => __('Army Address'),
//                'provider' => 'checkoutProvider',
//                'visible' => true,
//                'initialValue' => false,
//                'sortOrder' => 10,
//                'valueMap' => [
//                    'true' => true,
//                    'false' => false
//                ]
//            ];
        }

        return $jsLayout;
    }

    /**
     * Process provided address to contains checkbox and have trackable address fields.
     *
     * @param $addressFieldset - Address fieldset config.
     * @param $fieldName - fieldName
     * @param $dataScope - data scope
     * @param $deps - list of dependencies
     * @return array
     */
    private function processAddField($addressFieldset, $fieldName, $dataScope, $deps)
    {
        //Creates checkbox.
        $addressFieldset['custom_checkbox'] = [
            'component' => 'Magento_Checkout/js/single-checkbox',
            'config' => [
                'customScope' => $dataScope,
                'template' => 'ui/form/field',
                'prefer' => 'checkbox'
            ],
            'dataScope' => $dataScope . '.custom_checkbox',
            'deps' => $deps,
            'label' => __('Army Address'),
            'provider' => 'checkoutProvider',
            'visible' => true,
            'initialValue' => false,
            'sortOrder' => 10,
            'valueMap' => [
                'true' => true,
                'false' => false
            ]
        ];

        return $addressFieldset;
    }
}
