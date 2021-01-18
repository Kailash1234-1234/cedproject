<?php

namespace Ced\Brand\Observer;

class Changetext implements \Magento\Framework\Event\ObserverInterface
{   
    protected $indexFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Ced\Brand\Model\ResourceModel\Branddeletepost\CollectionFactory $branddeletepostFactory
        )
    {
        $this->_pageFactory = $pageFactory;
        $this->_branddeletepostFactory = $branddeletepostFactory;
    }
      

	public function execute(\Magento\Framework\Event\Observer $observer)
	{
        
          $post = $this->_branddeletepostFactory->create();
          $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
          $model = $objectManager->create('Ced\Brand\Model\Branddeletepost');

         $displayText = $observer->getData('mp_text');
        //  $displayText->getData('brand_id');
        //  $displayText->getData('brand_name');
        //  $displayText->getData('brand_image');
        //  $displayText->getData('brand_desc');
         $model->setData([
            'brand_name' => $displayText->getData('brand_name'),
            'brand_desc' => $displayText->getData('brand_desc'),
            'brand_status' =>$displayText->getData('brand_status'),
            'brand_image' => $displayText->getData('brand_image')
        ]);

        $model->save();
        // if($model->save()){
        //     $this->messageManager->addSuccessMessage(__('Data was saved.'));
        // } else {
        //     $this->messageManager->addErrorMessage(__('Data was not saved.'));
        // }
		return $this;
	}
}