<?php

namespace Ced\Customer\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;

class SaveCustomerAfter implements \Magento\Framework\Event\ObserverInterface
{
    protected $customer;

    protected $customerFactory;
    
    public function __construct(
        \Magento\Customer\Model\Customer $customer,
        CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Model\ResourceModel\CustomerFactory $customerFactory
    )
    {
        $this->customer = $customer;
        $this->customerFactory = $customerFactory;
        $this->_customerRepository= $customerRepository;
    }
    
	public function execute(\Magento\Framework\Event\Observer $observer)
	{
            $customer = $observer->getEvent()->getCustomer();
            $customerData = $observer->getEvent()->getRequest(); 
            $data=$customerData->getPostValue();
          
          
          
            if(isset($data['favorite_color'])){
                $color=implode(",",$data['favorite_color']);
                $customer->setCustomAttribute('favorite_color',$color);
            }
            
            if(isset($data['area_of_interest'])){
                $interest=implode(",",$data['area_of_interest']);
                $customer->setCustomAttribute('area_of_interest',$interest);
            }
          
            if(isset($data['active'])){
                $customer->setCustomAttribute('active',$data['active']);
            }

            if(isset($data['year_of_creadit_card'])){
                $customer->setCustomAttribute('year_of_creadit_card',$data['year_of_creadit_card']);
            }           
            $this->_customerRepository->save($customer);
       
        return $this;
    }
}
	