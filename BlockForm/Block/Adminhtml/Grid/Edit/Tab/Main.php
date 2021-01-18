<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created By : Rohan Hapani
 */
namespace Ced\BlockForm\Block\Adminhtml\Grid\Edit\Tab;

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
       
        array $data = []
    ) {
        $this->_adminSession = $adminSession;
      
     
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare the form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        
        $model = $this->_coreRegistry->registry('ced_blockform_form_data');

        $isElementDisabled = false;

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Brand Information')]);
    
        $fieldset->addField(
            'brand_name',
            'text',
            [
                'name' => 'brand_name',
                'label' => __('Brand Name'),
                'title' => __('Brand Name'),
                'required' => true,
            ]
        );
        $fieldset->addField(
            'brand_image',
            'file',
            [
                'name' => 'brand_image',
                'label' => __('Brand Image'),
                'title' => __('Brand Image'),
                'required' => true,
            ]
        );
      
       
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
        return __('Brand Information');
    }

    /**
     * Return Tab title
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Brand Information');
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