<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created By : Rohan Hapani
 */
namespace Ced\Emp\Controller\Adminhtml\Attribute;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Ced\Emp\Model\ResourceModel\Emppost\CollectionFactory;
use Magento\Backend\Model\Auth\Session;
use Magento\Catalog\Model\ResourceModel\Eav\AttributeFactory;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

/**
 * Mass Delete Record Controller
 */
class MassDelete extends \Magento\Backend\App\Action
{

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param Context           $context
     * @param Filter            $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        \Magento\Eav\Setup\EavSetupFactory $eavEavSetupFactory,
        \Magento\Eav\Model\ResourceModel\Entity\Attribute\CollectionFactory $eavcollectionFactory,
        \Magento\Eav\Model\ResourceModel\Entity\Attribute $eavResource
       
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->eavEavSetupFactory = $eavEavSetupFactory;
        $this->eavcollectionFactory = $eavcollectionFactory;
        $this->eavResource=$eavResource;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
            $id = $this->getRequest()->getParam('attribute_id');
            $customerSetup = $this->eavcollectionFactory->create();
            $deleteIds = $this->getRequest()->getPost('attribute_id');
            //echo $deleteIds;
            //  die;
            $customerSetup->addFieldToFilter('attribute_id', ['in' => $deleteIds]);
            $delete = 0;
            
            foreach ($customerSetup as $item) {
                $item->delete();
                $delete++;
            }

            // $customerEntity = $customerSetup->getEntityTypeId('emp');
            // $attributeSetId = $customerSetup->getDefaultAttributeSetId($customerEntity);
            // $attributeSet = $this->attributeSetFactory->create();
            // $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);
            // $attribute = $this->eavConfig->getAttribute(\Ced\Emp\Model\Emppost::ENTITY, $id)
            // ->addData([
            //     'attribute_set_id' => $attributeSetId,
            //     'attribute_group_id' => $attributeGroupId,
            //     'used_in_forms' => ['adminhtml_customer'],
            // ]);

        // $deleteIds = $this->getRequest()->getPost('attribute_id');
       
    
        // $attribute->addFieldToFilter('attribute_id', ['in' => $deleteIds]);
        // $delete = 0;
        // echo $deleteIds;
        // die;
        // foreach ($attribute as $item) {
        //     $item->delete();
        //     $delete++;
        // }

        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $delete));
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
