<?php
namespace Ced\Slider\Block;
class Hello1 extends \Magento\Framework\View\Element\Template
{    
    protected $_productCollectionFactory;
    protected $_sliderpostFactory;
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory, 
        \Ced\Slider\Model\SliderpostFactory $sliderpostFactory,
        
        array $data = []
    )
    {    
        $this->_productCollectionFactory = $productCollectionFactory;    
        $this->_sliderpostFactory = $sliderpostFactory; 
        
        parent::__construct($context, $data);
    }
    
    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setPageSize(10); // fetching only 3 products
        return $collection;
    } 
    public function getSliderpostCollection(){
        $sliderpost = $this->_sliderpostFactory->create();
        return $sliderpost->getCollection();
    } 


}
?>