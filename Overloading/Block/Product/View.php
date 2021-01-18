<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ced\Overloading\Plugin\Block\Product;
/**
 * Product View block
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class View extends \Magento\Catalog\Block\Product\View
{


    /**
     * Retrieve current product model
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct()
    {
       echo 'Local Block';
       if (!$this->_coreRegistry->registry('product') && $this->getProductId()) {
            $product = $this->productRepository->getById($this->getProductId());
            $this->_coreRegistry->register('product', $product);
        }
        return $this->_coreRegistry->registry('product');
    }


}
