<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created By : Rohan Hapani
 */
namespace Ced\Emp\Controller\Adminhtml\Attribute;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Edit form controller
 */
class Edit extends \Magento\Backend\App\Action
{

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Magento\Backend\Model\Session
     */
    protected $adminSession;

    /**
     * @var \Rh\Blog\Model\BlogFactory
     */
    protected $resultPageFactory;
    protected $employeeFactory;
    protected $eavReasource;

    /**
     * @param Action\Context                 $context
     * @param \Magento\Framework\Registry    $registry
     * @param \Magento\Backend\Model\Session $adminSession
     * @param \Rh\Blog\Model\BlogFactory     $blogFactory
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Model\Session $adminSession,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Eav\Model\ResourceModel\Entity\Attribute $eavReasource,
        \Magento\Eav\Model\Entity\AttributeFactory $emppostFactory
    ) {
        $this->_coreRegistry = $registry;
        $this->adminSession = $adminSession;
        $this->emppostFactory = $emppostFactory;
        $this->resultPageFactory = $resultPageFactory; 
        $this->eavReasource = $eavReasource;
        parent::__construct($context);
    }

    /**
     * @return boolean
     */
    protected function _isAllowed()
    {
        return true;
    }

    /**
     * Add blog breadcrumbs
     *
     * @return $this
     */
    protected function _initAction()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Ced_Emp::attribute')->addBreadcrumb(__('Emp'), __('Emp'))->addBreadcrumb(__('Manage Emp'), __('Manage Emp'));
        return $resultPage;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('attribute_id');
        //echo $id;
        // die;
        $model = $this->emppostFactory->create();
        if ($id) {
            $this->eavReasource->load($model,$id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This blog record no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
      

        $this->_coreRegistry->register('ced_emp_form_data', $model);

        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb($id ? __('Edit Attr') : __('New Attr'), $id ? __('Edit Attr') : __('New Attr'));
        $resultPage->getConfig()->getTitle()->prepend(__('Attribute'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Attribute'));
        return $resultPage;
    }
}