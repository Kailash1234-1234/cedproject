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
use Magento\Backend\Model\Auth\Session;
use Magento\Catalog\Model\ResourceModel\Eav\AttributeFactory;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

class Save extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $_adminSession;

    /**
     * @var \Rh\Blog\Model\BlogFactory
     */
    protected $emppostFactory;
    /**
     * @var AttributeFactory
     */
    protected $attributeFactory;
    protected $eavEavSetupFactory;
    protected $eavConfig;
    protected $attributeSetFactory;
    /**
     * @param Action\Context                      $context
     * @param \Magento\Backend\Model\Auth\Session $adminSession
     * @param \Rh\Blog\Model\BlogFactory          $blogFactory
     */
    public function __construct(
        Action\Context $context,
        \Magento\Backend\Model\Auth\Session $adminSession,
        \Ced\Emp\Model\EmppostFactory $emppostFactory,
        AttributeFactory $attributeFactory,
        \Magento\Eav\Setup\EavSetupFactory $eavEavSetupFactory,
        \Magento\Eav\Model\Config $eavConfig,       
        AttributeSetFactory $attributeSetFactory
    ) {
        parent::__construct($context);
        $this->_adminSession = $adminSession;
        $this->emppostFactory = $emppostFactory;
        $this->attributeFactory = $attributeFactory;
        $this->eavEavSetupFactory = $eavEavSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
        $this->eavConfig = $eavConfig;
    }

    /**
     * Save blog record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $postObj = $this->getRequest()->getPostValue();

        $resultRedirect = $this->resultRedirectFactory->create();
            $value = $postObj['attribute_code'];
            $type = $postObj['backend_type'];
            $input = $postObj['frontend_input'];
            $lavel = $postObj['frontend_label'];
            $isuserdefiend=$postObj['is_user_defined'];
            $required =  $postObj['is_required'];
           // $data=array
        if ($value) {
            $customerSetup = $this->eavEavSetupFactory->create();
            $customerEntity = $customerSetup->getEntityTypeId('emp');
            $attributeSetId = $customerSetup->getDefaultAttributeSetId($customerEntity);
            $attributeSet = $this->attributeSetFactory->create();
            $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);
            $customerSetup->addAttribute(\Ced\Emp\Model\Emppost::ENTITY, $value,[
                'type' => $type,
                'label' => $lavel,
                'input' => $input,
                'required' => $required,
                'visible' => true,
                'user_defined' => $isuserdefiend,
                'sort_order' => 90,
                'position' => 999,
                'system' => 0,
            ]);
            $attribute = $this->eavConfig->getAttribute(\Ced\Emp\Model\Emppost::ENTITY, $value);

            $id = $this->getRequest()->getParam('attribute_id');
            if ($id) {
                $attribute->load($id);
            }
            try {    
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->_adminSession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('emp/*/edit', ['attribute_id' => $attribute->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
            $this->_getSession()->setFormData($postObj);
            return $resultRedirect->setPath('*/*/edit', ['attribute_id' => $this->getRequest()->getParam('attribute_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}