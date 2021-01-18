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
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\Auth\Session;
use Magento\Catalog\Model\ResourceModel\Eav\AttributeFactory;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

/**
 * Delete Controller
 */
class Delete extends \Magento\Backend\App\Action
{

    /**
     * @var \Rh\Blog\Model\BlogFactory
     */
    protected $blogFactory;

    /**
     * @param Context                    $context
     * @param \Rh\Blog\Model\BlogFactory $blogFactory
     */
    public function __construct(
        Context $context,
        \Ced\Emp\Model\EmppostFactory $emppostFactory,
        \Magento\Eav\Setup\EavSetupFactory $eavEavSetupFactory,
        AttributeFactory $attributeFactory,
        \Magento\Eav\Model\Config $eavConfig,       
        AttributeSetFactory $attributeSetFactory
    ) {
        parent::__construct($context);
        $this->emppostFactory = $emppostFactory;
        $this->attributeFactory = $attributeFactory;
        $this->eavEavSetupFactory = $eavEavSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
        $this->eavConfig = $eavConfig;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ced_Emp::attributeview');
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('attribute_id');
       // echo $id;
        // die(__FILE__);
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $customerSetup = $this->eavEavSetupFactory->create();
            $customerEntity = $customerSetup->getEntityTypeId('emp');
            $attributeSetId = $customerSetup->getDefaultAttributeSetId($customerEntity);
            $attributeSet = $this->attributeSetFactory->create();
            $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);
            $attribute = $this->eavConfig->getAttribute(\Ced\Emp\Model\Emppost::ENTITY, $id)
            ->addData([
                'attribute_set_id' => $attributeSetId,
                'attribute_group_id' => $attributeGroupId,
                'used_in_forms' => ['adminhtml_customer'],
            ]);
            try {
                $attribute->load($id);
                $attribute->delete();
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