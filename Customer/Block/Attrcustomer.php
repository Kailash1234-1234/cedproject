<?php
namespace Ced\Customer\Block;

class Attrcustomer extends \Magento\Framework\View\Element\Template
{    
    protected $_productCollectionFactory;
    protected $_customer;
    protected $_customerFactory;
    protected $customerSession;  
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory, 
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Model\Customer $customers,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    )
    {    
        $this->_productCollectionFactory = $productCollectionFactory;    
        $this->_customerFactory = $customerFactory;
        $this->_customer = $customers;
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }
    
    public function getCustomerCollection() {
         $customerSession = $this->customerSession;
         $customerSession = $customerSession->getData();
        //  print_r($customerSession);
        // if(isset(!$customerSession)){  
        // }
         $customerId = $customerSession['customer_id'];
         return $this->_customer->getCollection()
               ->addAttributeToSelect("*")
               ->addAttributeToFilter("entity_id", $customerId)
               ->load();
    }

   
}
?>