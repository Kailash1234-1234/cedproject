<?php
	/**
	 * Hello Rewrite Product ListProduct Block
	 *
	 * @category    Webkul
	 * @package     Webkul_Hello
	 * @author      Webkul Software Private Limited
	 *
	 */
    namespace Ced\Overloading\Block;
    
	class Quantity extends \Magento\Catalog\Block\Product\View
	{

    public function getProductDefaultQty($product = null)
    {
        // die("88888");
        $qty=10;
        return $qty;
    }
	}