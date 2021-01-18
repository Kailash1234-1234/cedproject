<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ced\Brand\Controller\Adminhtml\Createmenu;
/**
 * Save CMS block action.
 */
class Branddatasave extends \Magento\Framework\App\Action\Action
{
    protected $indexFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Ced\Brand\Model\ResourceModel\Brandpost\CollectionFactory $brandpostFactory
        )
    {
        $this->_pageFactory = $pageFactory;
        $this->brandpostFactory = $brandpostFactory;
        return parent::__construct($context);
       
        
    }
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        //print_r($data);
        // die(__FILE__);
        $post = $this->brandpostFactory->create();
        $model = $this->_objectManager->create('Ced\Brand\Model\Brandpost');

        if(!empty($data['brand_id'])){
            $row=$post->addFieldToFilter('brand_id',$data['brand_id']);
            if(count($row)>0){
                $postUpdate = $model->load($data['brand_id']);
                $postUpdate->setBrandDesc($data['brand_desc']);
                $postUpdate->setBrandName($data['brand_name']);
                $postUpdate->setBrandStatus($data['brand_status']);
                $postUpdate->setCreatedat($data['created_at']);
                $postUpdate->save();
            }
        }
        else{
           
            //print_r($data);
            // die(__FILE__);  
        $model->setData([
            'brand_name' => $data['brand_name'],
            'brand_desc' => $data['brand_desc'],
            'brand_status' =>$data['brand_status'],
            'brand_image' => $data['brand_image'][0]['name']
        ]);
        $model->save();
        if($model->save()){
            $this->messageManager->addSuccessMessage(__('You saved the data.'));
        } else {
            $this->messageManager->addErrorMessage(__('Data was not saved.'));
        }
    }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('brand/createmenu/showbrand');
        return $resultRedirect;

    }
}
