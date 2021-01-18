<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created By : Rohan Hapani
 */
namespace Ced\Emp\Block\Adminhtml\Attribute\EditAttr\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Config\Model\Config\Source\Yesno;

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
     * @var Yesno
     */
    protected $_yesNo;
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
        Yesno $yesNo,
        array $data = []
    ) {
        $this->_adminSession = $adminSession;
        $this->_yesNo = $yesNo;
        $this->_status = $status;
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

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Attribute Information')]);
        $yesno = $this->_yesNo->toOptionArray();
        if ($model->getId()) {
            $fieldset->addField('attribute_id', 'hidden', ['name' => 'attribute_id']);
        }

        // $fieldset->addField(
        //     'entity_type_id',
        //     'text',
        //     [
        //         'name' => 'entity_type_id',
        //         'label' => __('Entity type Id'),
        //         'title' => __('Entity Id'),
        //         'required' => true,
        //     ]
        // );
        $fieldset->addField(
            'attribute_code',
            'text',
            [
                'name' => 'attribute_code',
                'label' => __('Attribute Code'),
                'title' => __('Attribute Code'),
                'required' => true,
            ]
        );
        $fieldset->addField(
            'frontend_label',
            'text',
            [
                'name' => 'frontend_label',
                'label' => __('Frontend Label'),
                'title' => __('Frontend Label'),
                'required' => true,
            ]
        );

        $fieldset->addField(
            'backend_type',
            'select',
            [
                'name' => 'backend_type',
                'label' => __('backend_type'),
                'title' => __('backend_type Title'),
                'options'=> $this->_status->getBackendTypeArray(),
                'required' => true,
            ]
        );
       
        $contentField = $fieldset->addField(
            'frontend_input',
            'select',
            [
                'name' => 'frontend_input',
                'label' => __('frontend_input'),
                'title' => __('frontend_input'),
                'options'=> $this->_status->getDataTypeArray(),
                'required' => true,
                'disabled' => $isElementDisabled,
            ]
        );
        // $contentField = $fieldset->addField(
        //     'is_required',
        //     'radio',
        //     [
        //         'name' => ' is_required',
        //         'label' => __(' is_required'),
        //         'title' => __(' is_required'),
        //         'required' => true,
        //         'disabled' => $isElementDisabled,
        //     ]
        // );

        $fieldset->addField(
            'is_user_defined',
            'select',
            [
                'name' => 'is_user_defined',
                'label' => __('Is User Defiend'),
                'title' => __('Default Value'),
                'values' => $yesno,
               // 'value' => $attributeObject->getDefaultValue()
            ]
        );
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);

        $fieldset->addField(
            'is_required',
            'select',
            [
                'label' => __('Is Required'),
                'title' => __('Status'),
                'name' => 'is_required',
                'required' => true,
                'options' => $this->_status->getOptionArray(),
                'disabled' => $isElementDisabled,
            ]
        );

        if (!$model->getId()) {
            $model->setData('is_required', $isElementDisabled ? '0' : '1');
        }

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
        return __('Attributes Information');
    }

    /**
     * Return Tab title
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Attributes Information');
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