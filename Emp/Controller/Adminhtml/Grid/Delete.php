<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created By : Rohan Hapani
 */
namespace Ced\Emp\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

/**
 * Delete Controller
 */
class Delete extends \Magento\Backend\App\Action
{

    /**
     * @var \Rh\Blog\Model\BlogFactory
     */
    protected $emppostFactory;

    /**
     * @param Context                    $context
     * @param \Rh\Blog\Model\BlogFactory $blogFactory
     */
    public function __construct(
        Context $context,
        \Ced\Emp\Model\EmppostFactory $emppostFactory
    ) {
        parent::__construct($context);
        $this->emppostFactory = $emppostFactory;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ced_Emp::view');
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->emppostFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('The post has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/index', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find a post to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}