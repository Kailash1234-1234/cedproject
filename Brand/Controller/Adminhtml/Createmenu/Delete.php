<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ced\Brand\Controller\Adminhtml\Createmenu;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Ced\Brand\Model\ResourceModel\Brandpost\CollectionFactory;

class Delete extends \Magento\Cms\Controller\Adminhtml\Block implements HttpPostActionInterface
{

  
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('id');
        //echo $id;
        //die(__FILE__);
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Ced\Brand\Model\Brandpost::class);
                $model->load($id);

                //event dispatch 
                $textDisplay = new \Magento\Framework\DataObject(array('text' => $model));
                $this->_eventManager->dispatch('ced_brand_display_text', ['mp_text' => $model]);
                $textDisplay->getText();
               

                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the block.'));
                // go to grid
                return $resultRedirect->setPath('brand/createmenu/showbrand');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['brand_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a block to delete.'));
        // go to grid
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('brand/createmenu/showbrand');
    }
}
