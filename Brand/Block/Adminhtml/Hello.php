<?php

/**
 *
 * @package     magento2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        https://www.codilar.com/
 */

namespace Ced\Brand\Block\Adminhtml;

use Magento\Framework\View\Element\Template;

class Hello extends Template
{
    protected $_productCollectionFactory;
    protected $_sliderpostFactory;
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory, 
        \Ced\Brand\Model\BrandpostFactory $brandpostFactory,
        
        array $data = []
    )
    {    
        $this->_productCollectionFactory = $productCollectionFactory;    
        $this->_brandpostFactory = $brandpostFactory; 
        
        parent::__construct($context, $data);
      
    }
    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setPageSize(10); // fetching only 3 products
        return $collection;
    } 

    public function getBrandProductCollection(){
        $likepostt = $this->_brandpostFactory->create();
        return $brandpost->getCollection();
    } 

    public function getText1() {
        
        return "Hello Menu i am Add slider !!!";
    }

    public function getBrand(){
        return "hello Admin i am slider listing";
    }
}
?>