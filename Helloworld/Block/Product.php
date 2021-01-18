<?php
namespace Ced\Helloworld\Block;
class Product extends \Magento\Framework\View\Element\Template
{    
    protected $_productCollectionFactory;
    protected $_likepostFactory;
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory, 
        \Ced\Helloworld\Model\LikepostFactory $likepostFactory,
        
        array $data = []
    )
    {    
        $this->_productCollectionFactory = $productCollectionFactory;    
        $this->_likepostFactory = $likepostFactory; 
        
        parent::__construct($context, $data);
    }
    
    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setPageSize(10); // fetching only 3 products
        return $collection;
    } 
    public function getLikeProductCollection(){
        $likepostt = $this->_likepostFactory->create();
        return $likepostt->getCollection();
    } 


}
?>