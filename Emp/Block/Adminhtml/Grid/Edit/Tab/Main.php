<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created By : Rohan Hapani
 */
namespace Ced\Emp\Block\Adminhtml\Grid\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

/**
 * Blog form block
 */
class Main extends Generic implements TabInterface
{

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $_adminSession;

    /**
     * @var \Rh\Blog\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param \Magento\Backend\Model\Auth\Session     $adminSession
     * @param \Rh\Blog\Model\Status                   $status
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Backend\Model\Auth\Session $adminSession,
        \Ced\Emp\Model\Status $status,
        \Magento\Eav\Model\Attribute $eavAttribute,
        \Magento\Eav\Model\Entity $entity,
        array $data = []
    ) {
        $this->_adminSession = $adminSession;
        $this->_status = $status;
        $this->_eavAttribute =$eavAttribute;
        $this->_entity =$entity;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare the form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        
        $model = $this->_coreRegistry->registry('ced_emp_form_data');

        $isElementDisabled = false;

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Employee Information')]);

        if ($model->getId()) {
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        }

        $collection = $this->_eavAttribute->getCollection();
        $collection->addFieldToFilter('entity_type_id', $this->_entity->setType('emp')->getTypeId());
        $collection->addFieldToFilter(
            'entity_type_id',
            $this->_entity->setType('emp')->getTypeId()
        );
        //print_r($collection->getData());


        foreach($collection as $data){
            $required=$data['is_required'];
            if($required==0){
                $required==true;
            }else {
                $required==false;
            }
            $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
            $fieldset->addField(
                $data['attribute_code'],
                $data['frontend_input'],
                [
                    'name' =>  $data['attribute_code'],
                    'label' => __($data['frontend_label']),
                    'title' => __($data['attribute_code']),
                    'required' =>$required,
                    'disabled' => $isElementDisabled,
                    'date_format' => $dateFormat,
                ]
            );
        }
       
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $form->addValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * Return Tab label
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Employee Information');
    }

    /**
     * Return Tab title
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Employee Information');
    }

    /**
     * Can show tab in tabs
     *
     * @return boolean
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Tab is hidden
     *
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}