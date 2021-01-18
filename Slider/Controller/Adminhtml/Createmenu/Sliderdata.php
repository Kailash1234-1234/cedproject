<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ced\Slider\Controller\Adminhtml\Createmenu;
/**
 * Save CMS block action.
 */
class Sliderdata extends \Magento\Framework\App\Action\Action
{
    protected $indexFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Ced\Slider\Model\ResourceModel\Sliderpost\CollectionFactory $sliderpostFactory
        )
    {
        $this->_pageFactory = $pageFactory;
        $this->sliderpostFactory = $sliderpostFactory;
        return parent::__construct($context);
       
        
    }
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        // print_r($data);
        // die(__FILE__);
        $post = $this->sliderpostFactory->create();
        $model = $this->_objectManager->create('Ced\Slider\Model\Sliderpost');
        if(!empty($data['slider_id'])){
            $row=$post->addFieldToFilter('slider_id',$data['slider_id']);
            if(count($row)>0){
                $postUpdate = $model->load($data['slider_id']);
                $postUpdate->setSliderDesc($data['slider_desc']);
                $postUpdate->setSliderName($data['slider_name']);
                $postUpdate->setSliderSortOrder( $data['slider_sort_order']);
                $postUpdate->setStoreId($data['store_id'][0]);
                $postUpdate->save();
            }
        }
        else{
            $storeId =implode(",",$data['store_id']);
            // print_r($storeId);
           // die(__FILE__);  
        $model->setData([
            'slider_name' => $data['slider_name'],
            'slider_sort_order' => $data['slider_sort_order'],
            'store_id' =>$storeId,
            'slider_image' => $data['slider_image'][0]['name'],
            'slider_desc' => $data['slider_desc']
        ]);
        $model->save();
        if($model->save()){
            $this->messageManager->addSuccessMessage(__('You saved the data.'));
        } else {
            $this->messageManager->addErrorMessage(__('Data was not saved.'));
        }
    }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('slider/createmenu/addslider');
        return $resultRedirect;

    }
}
