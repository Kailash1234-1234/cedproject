<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ced\Slider\Controller\Adminhtml\Createmenu;

use Magento\Framework\App\Action\HttpGetActionInterface;

/**
 * Edit CMS block action.
 */
class Editslider extends \Magento\Cms\Controller\Adminhtml\Block implements HttpGetActionInterface
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit CMS block
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('slider_id');
    //    echo $id;
    //    die(__FILE__);
        $model = $this->_objectManager->create(\Ced\Slider\Model\Sliderpost::class);
       
       // 2. Initial checking
        // if ($id) {
        //     $model->load($id);
        //     if (!$model->getSliderid()) {
        //         $this->messageManager->addErrorMessage(__('This block no longer exists.'));
        //         /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        //         $resultRedirect = $this->resultRedirectFactory->create();
        //         return $resultRedirect->setPath('*/*/');
        //     }
        // }

        $this->_coreRegistry->register('slider', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Block') : __('New Block'),
            $id ? __('Edit Block') : __('New Block')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Blocks'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Block'));
        return $resultPage;
    }
}
